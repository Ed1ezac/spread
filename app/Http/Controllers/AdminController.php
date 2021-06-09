<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRoleRequest;

class AdminController extends Controller
{
    //

    public function fundsReserve(){

        return view('admin.funds-reserves');
    }

    public function tasks(){
        return view('admin.tasks');
    }



    public function createFirstSuperAdmin(AdminRoleRequest $request){
        Auth::user()->assignRole(User::Administrator);
        return back()->with('status', 'admin priviledges granted');
    }
}
