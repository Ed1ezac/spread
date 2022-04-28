<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Sms;
use App\Models\Funds;
use App\Jobs\SendSms;
use App\Models\JobStatus;
use App\Models\SenderName;
use Illuminate\Support\Str;   
use Illuminate\Http\Request;
use App\Models\RecipientList;
use App\Events\RolloutComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VerifySmsRequest;
use App\Http\Requests\CreateSmsRequest;
use App\Http\Requests\EditDraftRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateSmsRequest;
use App\Http\Requests\EditScheduledSmsRequest;
use App\Http\Requests\ProcessScheduledImmediateRequest;

class SMSController extends Controller{

    public function index(Request $request){
        $sms = $this->getSMSFromSession();
        $senderNames = $this->getSenderNames();
        //$request->session()->put('sms', null);
        //$request->session()->put('sms_edit', null);
        
        $recipients = RecipientList::mine()->withStatus(RecipientList::Processed)->get();
        if(!Auth::user()->hasRole('client')){
            return view('dashboard.create-sms', compact('recipients', 'senderNames'))
                ->withErrors("This user account is suspended");
        }else return view('dashboard.create-sms', compact('sms', 'recipients', 'senderNames'));
    }

    public function summary(VerifySmsRequest $request){
        $this->putSMSOnSession($request);
        $sms = $this->getSMSFromSession();
        //dd($request->validated());
        $funds = Auth::user()->funds;
        $recipientsCount = RecipientList::find($sms->recipient_list_id)->entries;
        $recipients = RecipientList::mine()->get();
        $orderNo = isset($sms->order_no) ? $sms->order_no : '#SPX' . Str::random(7);

        return view('dashboard.sms-summary', compact('sms', 'recipients', 'recipientsCount', 'funds', 'orderNo'));
    }

    public function createAndQueue(CreateSmsRequest $request){
        $send_at = $this->determineSendingTime();
        $sendsNow = Carbon::now()->diffInMinutes($send_at) < 1;

        $sms = $this->createSms($send_at);

        $jobId = $this->dispatchSmsRolloutJob($sms);
        $sms->job_id = $jobId;
        $sms->save();
        $this->flushSession();

        if($sendsNow){
            if($request->input('vacant-in') !== null){
                return redirect('/statistics')->with('status',
                 'Sms created and queued. Estimated to send in ' .$request->input('vacant-in'));
            }else
                return redirect('/statistics')->with('status', 'Sms created, preparing to send...');
        }else{
            return redirect('/scheduled')->with('status', 'Sms rollout has been scheduled successfully');
        }
    }

    private function dispatchSmsRolloutJob($sms){
        $recipients = RecipientList::find($sms->recipient_list_id);
        return  Bus::chain([
                    new SendSms($sms, $recipients),
                    function () use ($sms, $recipients) {
                        $sms->update(['status' => Sms::Sent]);
                        RolloutComplete::dispatch($sms, $recipients->entries);
                    },
                ])->onQueue('rollouts')
                ->delay($sms->send_at)
                ->dispatch();
    }

    public function viewSms($id){
        $sms = Sms::find($id);

        $recipients = RecipientList::find($sms->recipient_list_id);
        $details = JobStatus::mine()->forJob($sms->job_id)->first();
        return view('dashboard.sms-details', compact('sms','recipients', 'details'));
    }

    public function resumeRollout(Request $request){
        //retry
    }

    public function saveDraft(Request $request){
        Sms::create([
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'status' => Sms::Draft,               
            'user_id' => Auth::id(),
        ]);
        return redirect('/drafts');
    }

    public function editDraft(EditDraftRequest $request){
        $this->putSMSOnSession($request);
        return redirect('/create');
    }

    public function deleteDraft(request $request){    
        $id = $request->id;    
        try{
            $draft = Sms::mine()->withId($id)->withStatus(Sms::Draft)->firstOrFail();
            $draft->delete();

            return back()->withErrors('Draft deleted!');
        }catch(Throwable $e){
            return back()->withErrors('The draft is either already deleted or not ascociated with your account.');
        }
    }
    
    //
    public function editScheduledSms(EditScheduledSmsRequest $request){
        $this->putSMSOnEditSession($request);
        $sms = $this->getSMSFromSession(true);
        //dd($sms);
        $funds = Auth::user()->funds;
        $recipientsCount = RecipientList::find($sms->recipient_list_id)->entries;
        $recipients = RecipientList::mine()->get();
        $orderNo = $sms->order_no;
        $send_at = $sms->send_at;
        return view('dashboard.sms-summary', compact('sms', 'recipients', 'recipientsCount', 'funds', 'orderNo','send_at'));
    }

    public function editScheduledSmsStep1(Request $request){
        $sms = $this->getSMSFromSession(true);
        $senderNames = $this->getSenderNames();
        $send_at = $sms->send_at;
        
        $recipients = RecipientList::mine()->withStatus(RecipientList::Processed)->get();
        if(!Auth::user()->hasRole('client')){
            return redirect('/create');
        }else return view('dashboard.create-sms', compact('sms', 'recipients', 'senderNames', 'send_at'));
    }

    public function updateScheduledSms(UpdateSmsRequest $request){
        //dd($request);
        $send_at = $this->determineSendingTime();
        try{
            $sms = $this->findAndUpdateSms($send_at);
            $this->findAndUpdateScheduledJob($sms->id);
            $this->flushSession();
            
            return redirect('/scheduled')->with('status', 'The Sms has beed updated.');
        }catch(Throwable $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function abortScheduledRollout(Request $request){
        $sms = Sms::find($request->id);
        //DB
        DB::table('jobs')->where('id', $sms->job_id)->delete();
        $sms->delete();

        return back()->withErrors('Sms rollout task aborted. Sms Deleted');
    }

    public function abortRollout(Request $request){
        //flag the sms as aborted, the Job will pick that up
        $sms = Sms::find($request->id);
        $status = JobStatus::mine()->forJob($sms->job_id)
                ->withStatus(JobStatus::STATUS_EXECUTING)
                ->where('trackable_id', $sms->id)->first();
        $processed = ($status->progress_now/$status->progress_max);   
        if(($processed < 0.15) && ($status->progress_now < 1500)){
            $sms->update(['status' => Sms::Aborted]);
            //pass-to-session
            $aborted = true;
            $maxProgress = $status->progress_now;
            return back()->with('aborted',$aborted)
                    ->with('maxProgress',$maxProgress)->withErrors('Sms rollout task has been stopped.');
        }else{
            return back()->withErrors('Sorry.. sms rollout can\'t be stopped at this stage.');
        }
    }

    public function processScheduledRolloutNow(ProcessScheduledImmediateRequest $request){
        $sms = Sms::find($request->id);
        if(!Auth::user()->hasRole('client')){
            $this->killSMS($sms);
            return redirect()->back();
        }
        DB::table('jobs')
        ->where([
            ['id', '=',$sms->job_id],
            ['queue', '=', 'rollouts']
        ])->update(['available_at' => Carbon::now()->addSeconds(6)->timestamp]);

        return redirect('/statistics')->with('status', 'Sms queued...');
    }

    private function getSenderNames(){
        $names = array('Spread');
        $res = SenderName::where('user_id', Auth::id())
                        ->withStatus(SenderName::Approved)
                        ->pluck('sender_name');
        if(isset($names) && count($names)>0){
            foreach($res as $n){ $names[] = $n; }
        }
        return $names;
    }

    private function determineSendingTime(){
        $request = request();
        if($request->input('sending_time') == 'now'){
            return Carbon::now()->addSeconds(6);
        }else if($request->input('sending_time') == 'later'){
            return Carbon::createFromFormat('d.m.Y H:i',
                $request->input('day').''.$request->input('time')
            );
        }
    }

    private function createSms($send_at){
        $request = request();
        return Sms::create([
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'order_no' => $request->input('order_no'),
            'status' => Sms::Pending,
            'recipient_list_id'=> $request->input('recipient_list_id'),
            'send_at' => $send_at,
            'user_id' => Auth::id(),
        ]);
    } 

    private function findAndUpdateSms($send_at){
        $request = request();
        $sms = Sms::mine()
                ->withId($request->input('id'))
                ->withOrderId($request->input('order_no'))
                ->withStatus(Sms::Pending)
                ->first();
        $sms->update([
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'recipient_list_id' => $request->input('recipient_list_id'),
            'send_at' => $send_at,
        ]);
        return $sms;
    }

    private function findAndUpdateScheduledJob($id){
        $sms = Sms::find($id);
        DB::table('jobs')
           ->where('id', $sms->job_id)
           ->update(['available_at' =>
                Carbon::createFromFormat('Y-m-d H:i:s', $sms->send_at)->timestamp]);
    }

    private function killSMS($sms){
        DB::table('jobs')
        ->where([
            ['id', '=',$sms->job_id],
            ['queue', '=', 'rollouts']
        ])->delete();
        $sms->update(['status' => Sms::Failed]);
    }

    private function putSMSOnSession(Request $request){
        if(empty(request()->session()->get('sms'))){
            $sms = new Sms();
            $sms->fill($request->validated());
            $request->session()->put('sms', $sms);
        }else{
            $sms = request()->session()->get('sms');
            $sms->fill($request->validated());
            $request->session()->put('sms', $sms);
        }
    }

    public function getSMSFromSession($isEdit = false){
        if($isEdit){
            if(!empty(request()->session()->get('sms_edit'))){
                return request()->session()->get('sms_edit');
            }
        }else{
            if(!empty(request()->session()->get('sms'))){
                return request()->session()->get('sms');
            }
        }
        return Sms::empty();
    }

    private function putSMSOnEditSession(Request $request){
        if(empty(request()->session()->get('sms_edit'))){
            $sms = new Sms();
            $sms->fill($request->validated());
            if(null !== ($request->input('id')))
                $sms->id = $request->input('id');
            $request->session()->put('sms_edit', $sms);
        }else{
            $sms = request()->session()->get('sms_edit');
            $sms->fill($request->validated());
            if(null !== ($request->input('id')))
                $sms->id = $request->input('id');
            $request->session()->put('sms_edit', $sms);
        }
    }

    private function flushSession(){
        //$sms = new Sms();
        //if(!empty(request()->session()->get('sms_edit'))){
        //    $temp = request()->session()->get('sms_edit');
        //    $sms->message = $temp->message;
        //}
        request()->session()->put('sms_edit', null);
    }

}
