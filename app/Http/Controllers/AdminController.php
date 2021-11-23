<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\User;
use App\Models\Reserve;
use App\Helpers\Orange;
use App\Models\JobStatus;
use Illuminate\Http\Request;
use App\Models\RecipientList;
use App\Helpers\FundsProcessing;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SmsApiToken as Token;
use App\Http\Requests\Admin\TestSmsRequest;
use App\Http\Requests\Admin\AdminRoleRequest;
use App\Http\Requests\Admin\AssignRoleRequest;
use App\Http\Requests\Admin\RemoveRoleRequest;
use App\Http\Requests\Admin\CreditUserFundsRequest;
use App\Http\Requests\Admin\DeductUserFundsRequest;

class AdminController extends Controller
{
    private $fundsProcessor;
    private $orangConfig;

    public function __construct(FundsProcessing $fundsProcessor)
    {
        $this->fundsProcessor = $fundsProcessor;
    }
    
    public function reserve(){
        $reserve = Reserve::first();

        $history = DB::table('reserve_records')
                    ->join('users', 'reserve_records.triggering_user_id', '=', 'users.id')
                    ->select('users.name', 'reserve_records.*')
                    ->latest()
                    ->paginate(8);
                    
        return view('admin.reserves', compact('reserve', 'history'));
    }

    public function makeReserve(){
        return view('admin.create-reserve');
    }

    public function createReserve(Request $request){
        //
        Reserve::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/admin/funds-reserve')->with('status', 'Reserve created successfully.');
    }

    public function smses(){
        $allSmses = Sms::count();
        $drafts = Sms::where('status','draft')->count();
        $sentSmses = Sms::where('status','sent')->count();
        $failedSmses = Sms::where('status','failed')->count();
        $abortedSmses = Sms::where('status','aborted')->count();
        $pendingSmses = Sms::where('status','pending')->count();
        $smses = Sms::latest()->paginate(7);
        return view('admin.smses', compact('smses','drafts', 'allSmses','pendingSmses', 'sentSmses', 'failedSmses','abortedSmses'));
    }

    public function tasks(){
        $history = JobStatus::where('queue', '!=','fileprocessing')->latest()->paginate(8);
        return view('admin.tasks', compact('history'));
    }

    public function viewTask($id){
        $task = JobStatus::find($id);
        $user = User::find($task->user_id);
        $sms = Sms::find($task->trackable_id);
        return view('admin.view-rollout-task', compact('task', 'user', 'sms'));
    }

    public function users(){
        $users = User::paginate(8);//with(['funds', 'roles'])->get();
        return view('admin.users', compact('users'));
    }

    public function editUserFunds($id){
        $user = User::find($id);
        return view('admin.edit-user-funds', compact('user'));
    }

    public function creditUserFunds(CreditUserFundsRequest $request){
        $data = $request->validated();
        $this->fundsProcessor->incrementUserFunds($data['userId'],$data['amount']);
        $user = User::find($data['userId']);

        return redirect('/admin/users')
            ->with('status', $user->name.' has been credited with '.$data['amount'].' funds.');
    }

    public function deductUserFunds(DeductUserFundsRequest $request){
        $data = $request->validated();
        $this->fundsProcessor->decrementUserFunds($data['userId'],$data['amount']);
        $user = User::find($data['userId']);
        
        return redirect('/admin/users')
            ->with('status', $user->name.'\'s funds have been reduced by '.$request->amount);
    }

    public function editUserRoles($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.edit-user-roles', compact('user', 'roles'));
    }

    public function assignRole(AssignRoleRequest $request){
        $data = $request->validated();
        $user = User::find($data['userId']);
        $user->assignRole($data['role']);

        return redirect('/admin/users')
            ->with('status', $user->name.' is now a '.$data['role'].'.');
    }

    public function removeRole(RemoveRoleRequest $request){
        $data = $request->validated();
        $user = User::find($data['userId']);
        $user->removeRole($data['role']);

        return redirect('/admin/users')
            ->with('status', $user->name.' is no longer a '.$data['role'].'.');
    }

    public function files(){
        $files = RecipientList::paginate(8);
        $allFiles = RecipientList::get()->count();
        $totalSize = RecipientList::sum('file_size'); 
        return view('admin.files', compact('files','allFiles','totalSize'));
    }

    public function orangeInfo(){
        $token = Token::first();
        $this->orangeConfig = array('token'=> $token->value);
        $orange = new Orange($this->orangeConfig);
        $contract = $this->getCoreContractInfo($orange->getAdminContracts(''));
        $statistic = $this->getCoreStatisticInfo($orange->getAdminStats());

        return view('admin.orange-info', compact('token','contract','statistic'));
    }

    private function getCoreContractInfo($rawBalance){
        $core = array();
        if(!empty($rawBalance['partnerContracts']['contracts'])){
            $core = $rawBalance['partnerContracts']['contracts'][0]['serviceContracts'];
        }
        return $core;
    }

    private function getCoreStatisticInfo($rawStatistic){
        $core = array();
        if(!empty($rawStatistic['partnerStatistics']['statistics'][0]['serviceStatistics'])){
            $core = $rawStatistic['partnerStatistics']['statistics'][0]['serviceStatistics'][0];    
        }
        return $core;
    }

    public function testSms(){

        return view('admin.send-sms');
    }

    public function sendTestSms(TestSmsRequest $request){
        $orange = new Orange(array('token'=> Token::first()->value));
        //attempt to send text, return response
        $response = $orange->sendSms(
                'tel:+267'.Orange::API_NUMBER,
                'tel:+267'.substr($request->input('recipient'), -8),
                $request->input('message'),
            );

        if(isset($response['error'])){
            return back()->withErrors($response['error']);
        }else{
            return back()->with('status', 'The sms has been sent successfully');
        }
    }

    //-----------------
    public function createFirstSuperAdmin(AdminRoleRequest $request){
        Auth::user()->assignRole(User::Administrator);
        return back()->with('status', 'admin priviledges granted');
    }
}
