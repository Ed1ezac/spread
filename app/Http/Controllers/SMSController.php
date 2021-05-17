<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SMSController extends Controller
{
    //
    public function verify(Request $request){
        //validate
        //dd($request);
        $validator = $this->validateSms($request);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            //summary page
            return redirect('/create/summary');
        }

    }

    public function save(Request $request){
        //dd($request);
        $validator = $this->validateSms($request);
        //-----
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            //save the draft
            Sms::create([
                'sender' => $request->input('sender'),
                'message' => $request->input('message'),
                'status' => 'draft',
                'recipient_list_id'=> $request->input('recipient-list-id'),
                /////////////////////////
                'user_id' => Auth::id(),
            ]);
            return redirect('/drafts');
        }
    }

    public function summary(){
        $recipients = RecipientList::where('user_id', Auth::id())->get();
        return view('dashboard.sms-summary', compact('recipients'));
    }

    public function confirm(Request $request){
        
        if($request->input('sending_time') == 'now'){
            dd($request);
        }else if($request->input('sending_time') == 'later'){
            //date format: DD.MM.YYYY
            dd($request);
        }
        
        /*$sms = Sms::create([
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'status' => 'pending',
            'recipient_list_id'=> $request->input('recipient-list-id'),
            /////////////////////////
            'user_id' => Auth::id(),
        ]);
        $sms->save();*/

        return redirect('/statistics')->with('status', 'Sms created...');
    }

    public function rollout(Request $request){

    }

    public function schedule(Request $request){

    }

    private function validateSms(Request $request){
        return Validator::make($request->all(),[
            'sender' => ['required','max:16'],
            'message' => ['required', 'max:140'],
            'recipient-list-id'=>['required', 'numeric'],
        ]);
    }
}
