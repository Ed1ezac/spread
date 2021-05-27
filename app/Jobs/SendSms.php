<?php

namespace App\Jobs;

use Exception;
use Throwable;
use App\Models\Sms;
use App\Models\RecipientList;
use Illuminate\Bus\Queueable;
use App\Events\ReportProgress;
use App\Helpers\FileProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;
    public $deleteWhenMissingModels = true; 

    public $sms;
    private $recipients;
    private $currentProgress = 0;
    private $reportFrequenceyModifier = 10;

    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
        $this->recipients = RecipientList::find($sms->recipient_list_id);        
    }

    public function handle()
    {
        $this->startTracking($this, $this->sms);
        $this->setProgressMax($this->recipients->entries);
        try{
            $this->jobStatus->markAsExecuting();

            $this->performRollout();
            
            $this->jobStatus->markAsFinished();
        }catch(Throwable $e){
            $this->beforeFail($e);
            $this->fail($e);
        }
    }

    private function beforeFail(Throwable $e){
        $this->jobStatus->markAsFailed($e->getMessage());
        if(!$e->getMessage() == 'Aborted by user.'){
            $this->sms->update(['status' => Sms::Failed]);
        }
        //fire event, Todo: new Failed event
        //RolloutComplete::dispatch($this->sms);
    }

    private function performRollout(){
        $worksheet = FileProcessing::openFile(
                $this->recipients->file_path, 
                $this->recipients->file_extension
            );

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);//only cells with data
            foreach ($cellIterator as $cell) {
                if(FileProcessing::isValidBwNumber(strval($cell->getValue()))){
                    $this->sendMessageTo(strval($cell->getValue()));
                    $this->incrementProgress();
                    $this->reportProgress();
                }
                // $this->sms->status === Sms::Aborted
                if(DB::table('sms')->find($this->sms->id)->status === Sms::Aborted){
                    throw new Exception('Aborted by user.');
                }           
            }
        }
    }

    private function sendMessageTo(String $number){
        //sms API logic here
        //usleep(10000);//10 millis
        //sleep(1);
    }

    private function reportProgress(){ 
        /*if(($this->currentProgress%$this->reportFrequenceyModifier == 0) || 
            $this->currentProgress == $this->recipients->entries){*/
                $jobInfo = [ 
                    'smsId' => $this->sms->id,
                    'userId' => $this->sms->user_id,
                    'total' => $this->progressMax,
                    'current' => $this->progressNow,
                    'smsSender' => $this->sms->sender,
                    'smsMessage' => $this->sms->message,
                    'smsRecipientsName' => $this->recipients->name,
                ];
            //dispatch progress event
            ReportProgress::dispatch($jobInfo);
        //}
    }

}
