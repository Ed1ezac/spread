<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    //
    public function verify(Request $request){
        //validate
        $validator = Validator::make($request->all(),[
            'sender' => ['required','max:16'],
            'message' => ['required', 'max:140'],
            'messaging-list-id'=>['required', 'numeric'],
        ]);

        if($validator->fails()){
            return back()->withErrors();
        }else{
            //summary page
            //return redirect('/create/summary');
        }

    }

    public function rollout(Request $request){

    }

    public function schedule(Request $request){

    }
}
