<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Sms;
use App\Jobs\SendSms;
use App\Models\JobStatus;   
use Illuminate\Http\Request;
use App\Models\RecipientList;
use App\Events\RolloutComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SMSController extends Controller
{
    //
    public function verify(Request $request){
        $validator = $this->validateSms();

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            //summary page
            return redirect('/create/summary');
        }

    }

    public function save(Request $request){
        $validator = $this->validateSms();
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            //save the draft
            Sms::create([
                'sender' => $request->input('sender'),
                'message' => $request->input('message'),
                'status' => Sms::Draft,               
                'user_id' => Auth::id(),
            ]);
            return redirect('/drafts');
        }
    }

    public function deleteDraft(request $request){    
        $id = $request->id;    
        try{
            $draft = Sms::where([
                ['id', '=', $id],
                ['status', '=', Sms::Draft],
                ['user_id', '=', Auth::id()]
            ])->firstOrFail();
            $draft->delete();

            return back()->withErrors('Draft deleted!');
        }catch(Throwable $e){
            return back()->withErrors('The draft is either already deleted or not ascociated with your account.');
        }
    }

    public function summary(){
        $recipients = RecipientList::where('user_id', Auth::id())->get();
        return view('dashboard.sms-summary', compact('recipients'));
    }

    public function confirm(Request $request){
        $validator = $this->validateSms();
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $send_at = $this->determineSendingTime();
        $sendsNow = Carbon::now()->diffInMinutes($send_at)<1;

        if(!$sendsNow && Carbon::today()->diffInDays($send_at)>14){
            return back()->withErrors('Period must be within 14 days');
        }

        if($request->input('smsId') != null){
            //Only update
            try{
                $this->updateSms($send_at);
                return redirect()->action([SMSController::class, 'updateScheduledSms'], 
                            [$request->input('smsId')]);
            }catch(Exception $e){
                return back()->withErrors($e->getMessage());
            }
        }

        $sms = $this->createSms($send_at);

        $jobId = $this->dispatchSmsRolloutJob($sms);
        $sms->job_id = $jobId;
        $sms->save();

        if($sendsNow){
            return redirect('/statistics')->with('status', 'Sms created, preparing to send...');
        }else{
            return redirect('/scheduled')->with('status', 'Sms rollout has beed scheduled successfully');
        }
    }

    private function dispatchSmsRolloutJob($sms){
        return  Bus::chain([
                    new SendSms($sms),
                    function () use ($sms) {
                        $sms->status = Sms::Sent;
                        $sms->save();
                        RolloutComplete::dispatch($sms);
                    },
                ])->onQueue('rollouts')
                ->delay($sms->send_at)
                ->dispatch();
    }

    public function updateScheduledSms($id){
        $sms = Sms::find($id);

        DB::table('jobs')
           ->where('id', $sms->job_id)
           ->update(['available_at' => //$sms->send_at]);
                Carbon::createFromFormat('Y-m-d H:i:s', $sms->send_at)->timestamp]);
        
        return redirect('/scheduled')->with('status', 'Sms has beed updated...');
    }

    public function abortScheduledRollout(Request $request){
        $sms = Sms::find($request->id);
        //DB
        DB::table('jobs')->where('id', $sms->job_id)->delete();
        $sms->delete();
        //$sms->save();

        return back()->withErrors('Sms rollout task aborted. Sms Deleted');
    }

    public function abortRollout(Request $request){
        //flag the sms as aborted and 'hope' the Job will pick that up
        $sms = Sms::find($request->id);
        //
        $status = JobStatus::where([
            ['user_id', '=', Auth::id()],
            ['job_id', '=', $sms->job_id],
            ['trackable_id', '=', $sms->id]
        ])->first();
        if($status->status === 'finished'){
            return back()->withErrors('Sms rollout task cannot be aborted at this stage.');
        }else{
            $sms->update(['status' => Sms::Aborted]);
        }

        return back()->withErrors('Sms rollout task will be aborted shortly.');
    }

    public function processScheduledRolloutNow(Request $request){
        $sms = Sms::find($request->id);
        DB::table('jobs')
           ->where('id', $sms->job_id)
           ->update(['available_at' => Carbon::now()->addSeconds(6)->timestamp]);

        return redirect('/statistics')->with('status', 'Sms sending...');
    }

    private function validateSms(){
        $request = request();
        return Validator::make($request->all(),[
            'sender' => ['required','max:16'],
            'message' => ['required', 'max:140'],
            'recipient-list-id'=>['required', 'numeric'],
        ]);
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
            'status' => Sms::Pending,
            'recipient_list_id'=> $request->input('recipient-list-id'),
            'send_at' => $send_at,
            'user_id' => Auth::id(),
        ]);
    } 

    private function updateSms($send_at){
        $request = request();
        $sms = Sms::where([
            ['id', '=',$request->input('smsId')],
            ['user_id','=', Auth::id()]
        ])->first();
        $sms->sender = $request->input('sender');
        $sms->message = $request->input('message');
        $sms->recipient_list_id = $request->input('recipient-list-id'); 
        $sms->send_at = $send_at;
        $sms->save();
    }
}
