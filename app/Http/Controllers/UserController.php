<?php

namespace App\Http\Controllers;

use App\Models\SenderName;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function userSettings(){
        $user = Auth::user();
        $senderNames = SenderName::where('user_id', $user->id)->get();  
        return view('dashboard.settings', compact('user', 'senderNames'));
    }

    public function updatePersonalInfo(Request $request){
        $data = $request->validate([
            'name' => ['required','max:50'],
            'email' => ['required', 'email','max:100', 'unique:users'],
            'institution' => ['required','max:100'],
        ]);
        $user = Auth::user();
        if($user->email != $data['email']){
            //there has been a change-gotta nullify the verification!
            $user->email_verified_at = null;
            $user->save;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'institution' => $data['institution']
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
