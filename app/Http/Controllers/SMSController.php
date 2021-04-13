<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SMSController extends Controller
{
    //
    public function verify(Request $request){
        //validate
        //dd($request);
        $validator = Validator::make($request->all(),[
            'sender' => ['required','max:16'],
            'message' => ['required', 'max:140'],
            'recipient-list-id'=>['required', 'numeric'],
        ]);

        if($validator->fails()){
            return back()->withErrors();
        }else{
            //summary page
            return redirect('/create/summary');
        }

    }

    public function rollout(Request $request){

    }

    public function schedule(Request $request){

    }
}
