<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function userSettings(){
        $user = Auth::user();
        return view('dashboard.settings', compact('user'));
    }

    public function updatePersonalInfo(Request $request){
        $data = $request->validate([
            'name' => ['required','max:50'],
            'email' => ['required', 'email','max:100', 'unique:users'],
        ]);
        $user = Auth::user();
        if($user->email != $data['email']){
            //there has been a change-gotta nullify the verification!
            $user->email_verified_at = null;
            $user->save;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        return back()->with('status', 'Your personal info has been updated.');

    }

    public function updateSecurity(Request $request){
        $user = Auth::user();

        if(!(Hash::check($request->input('old_password'), $user->password))){
            return redirect('/settings')->withErrors(['old_password' => 'didn\'t match current password.']);
        }

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($data['password']);
        $user->save();
        return back()->with('status', 'Your login password has been changed successfully.');
    }

    public function suspendUser(){
        //
    }

}