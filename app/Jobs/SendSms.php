<?php

namespace App\Jobs;

use Exception;
use Throwable;
use App\Models\Sms;
use App\Models\Funds;
use App\Traits\Trackable;
use App\Traits\FlagsAbortion;
use App\Models\RecipientList;
use Illuminate\Bus\Queueable;
use App\Events\ReportProgress;
use App\Events\RolloutComplete;
use App\Helpers\FileProcessing;
use App\Helpers\FundsProcessing;
use App\Helpers\FileChunkReadFilter;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, 
        SerializesModels, Trackable, FlagsAbortion;
    public $deleteWhenMissingModels = true; 

    public $sms;
    private $recipients;
    private $fundsProcessor;

    public function __construct(Sms $sms, RecipientList $list)
    {
        $this->sms = $sms;
        $this->recipients = $list;   
        $this->fundsProcessor = new FundsProcessing();
    }

    public function handle()
    {
        $this->startTracking($this, $this->sms);
        $this->setProgressMax($this->recipients->entries);
        $this->prepareSmsStatusPolling();
        try{
            $this->verifySufficientFunds();
            $this->jobStatus->markAsExecuting();

            $this->performRollout();
            
            $this->billUser();
            $this->jobStatus->markAsFinished();
        }catch(Throwable $e){
            $this->beforeFail($e);
            $this->fail($e);
        }
    }

    private function performRollout(){
        $chunkFilter = new FileChunkReadFilter();
        $reader = FileProcessing::createReader($this->recipients->file_extension);
        $maxRows = FileProcessing::getMaxRowSnapShot($reader, $this->recipients->file_path);
        $reader->setReadFilter($chunkFilter);

        for($startRow = 1; $startRow <= $maxRows; $startRow += FileChunkReadFilter::chunkSize) {
            $chunkFilter->setRows($startRow);
            $spreadsheet = FileProcessing::loadFile($reader, $this->recipients->file_path);
            //validate entries
            $this->validateAndSendSms($spreadsheet->getActiveSheet());
        }
        
    }

    private function validateAndSendSms($worksheet){
        foreach($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);//only cells with data
            foreach($cellIterator as $cell) {
                if(FileProcessing::isValidBwNumber(strval($cell->getValue()))){
                    $this->sendMessageTo(strval($cell->getValue()));
                    $this->incrementProgress();
                    $this->reportProgress();
                }
               
                if($this->progressNow <= $this->abortionThreshHold){
                    if($this->isAborted($this->sms->id, $this->progressNow)){
                        throw new Exception('Aborted by user.');
                    }
                } 
            }
        }
    }

    private function prepareSmsStatusPolling(){
        $this->setAbortionThreshHold($this->progressMax);
        $this->setFrequency($this->progressMax);
    }

    private function verifySufficientFunds(){    
        if(!($this->fundsProcessor
            ->hasSufficientFunds($this->sms->user_id, 
                        $this->recipients->entries))){
            throw new Exception('Insufficient funds.');
        }
    }

    private function beforeFail(Throwable $e){
        $this->billUser();
        $this->jobStatus->markAsFailed($e->getMessage());
        if($e->getMessage() !== 'Aborted by user.'){
            $this->sms->update(['status' => Sms::Failed]);
        }
        //fire event
        RolloutComplete::dispatch($this->sms, $this->progressNow)->delay(now()->addSeconds(6));
    }

    private function sendMessageTo(String $number){
        //sms API logic here
        //usleep(10000);//10 millis
        //sleep(1);
    }

    private function reportProgress(){ 
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
    }

    private function billUser(){
        if($this->progressNow > 0){
            $this->fundsProcessor->decrementUserFunds($this->sms->user_id, $this->progressNow);
        }
    }

}
