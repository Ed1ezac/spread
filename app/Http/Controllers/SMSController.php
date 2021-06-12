<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Sms;
use App\Models\Funds;
use App\Jobs\SendSms;
use App\Models\JobStatus;   
use Illuminate\Http\Request;
use App\Models\RecipientList;
use App\Events\RolloutComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateSmsRequest;
use Illuminate\Support\Facades\Validator;

class SMSController extends Controller
{
    //
    public function viewSms($id){
        //
        $sms = Sms::find($id);
        $recipients = RecipientList::find($sms->recipient_list_id);
        $details = JobStatus::mine()->forJob($sms->job_id)->first();
        return view('dashboard.sms-details', compact('sms','recipients', 'details'));
    }

    public function createAndQueue(CreateSmsRequest $request){
        $send_at = $this->determineSendingTime();
        $sendsNow = Carbon::now()->diffInMinutes($send_at)<1;

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

    public function saveDraft(Request $request){
        Sms::create([
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'status' => Sms::Draft,               
            'user_id' => Auth::id(),
        ]);
        return redirect('/drafts');
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

    public function verify(Request $request){
        //summary page
        return redirect()
            ->action([SMSController::class, 'summary'],
                ['recipientsId'=> $request->input('recipient-list-id')]);
    }

    public function summary($recipientsId){
        $funds = Auth::user()->funds;
        $recipientsCount = RecipientList::find($recipientsId)->entries;
        $recipients = RecipientList::mine()->get();
        return view('dashboard.sms-summary', compact('recipients', 'recipientsCount', 'funds'));
    }

    public function update(CreateSmsRequest $request){
        $send_at = $this->determineSendingTime();
        try{
            $this->updateSms($send_at);
            return redirect()->action([SMSController::class, 'updateScheduledSms'], 
                        [$request->input('smsId')]);
        }catch(Throwable $e){
            return back()->withErrors($e->getMessage());
        }
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

        return back()->withErrors('Sms rollout task aborted. Sms Deleted');
    }

    public function abortRollout(Request $request){
        //flag the sms as aborted and 'hope' the Job will pick that up
        $sms = Sms::find($request->id);
        //
        $status = JobStatus::mine()
                ->forJob($sms->job_id)
                ->withStatus(JobStatus::STATUS_EXECUTING)
                ->where('trackable_id', $sms->id)->first();

        $sms->update(['status' => Sms::Aborted]);
        return back()->withErrors('Sms rollout task has been stopped.');
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
        $sms = Sms::mine()->withId($request->input('smsId'))->first();
        $sms->update([
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'recipient_list_id' => $request->input('recipient-list-id'),
            'send_at' => $send_at,
        ]);
    }
}
