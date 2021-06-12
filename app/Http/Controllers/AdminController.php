<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\User;
use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Helpers\FundsProcessing;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\AdminRoleRequest;
use App\Http\Requests\Admin\AssignRoleRequest;
use App\Http\Requests\Admin\RemoveRoleRequest;
use App\Http\Requests\Admin\CreditUserFundsRequest;
use App\Http\Requests\Admin\DeductUserFundsRequest;

class AdminController extends Controller
{
    private $fundsProcessor;

    public function __construct(FundsProcessing $fundsProcessor)
    {
        $this->fundsProcessor = $fundsProcessor;
    }
    public function reserve(){
        $reserve = Reserve::first();
        //$records = ReserveRecord

        return view('admin.reserves', compact('reserve'));
    }

    public function editReserve(){
        $reserve = Reserve::first();
        return view('admin.edit-reserve', compact('reserve'));
    }

    public function smses(){
        $smses = Sms::paginate(7);
        return view('admin.smses', compact('smses'));
    }

    public function tasks(){
        return view('admin.tasks');
    }

    public function users(){
        $users = User::all();//with(['funds', 'roles'])->get();
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

    //-----------------
    public function createFirstSuperAdmin(AdminRoleRequest $request){
        Auth::user()->assignRole(User::Administrator);
        return back()->with('status', 'admin priviledges granted');
    }
}
