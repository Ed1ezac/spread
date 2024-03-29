<?php

namespace App\Jobs;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Sms;
use App\Models\User;
use App\Models\Funds;
use App\Helpers\Orange;
use App\Traits\SendsMail;
use App\Traits\Trackable;
use App\Mail\RolloutBegun;
use App\Mail\RolloutFailed;
use App\Traits\ResumesJobs;
use App\Helpers\RateLimiter;
use App\Traits\FlagsAbortion;
use App\Models\RecipientList;
use Illuminate\Bus\Queueable;
use App\Events\ReportProgress;
use App\Events\RolloutComplete;
use App\Helpers\FileProcessing;
use App\Helpers\FundsProcessing;
use App\Helpers\FileChunkReadFilter;
use App\Models\SmsApiToken as Token;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\DelegatesSendingBandwidth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\RolloutComplete as CompletionEmail;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, 
        SerializesModels, DelegatesSendingBandwidth,
        Trackable, FlagsAbortion, SendsMail, ResumesJobs;
    public $deleteWhenMissingModels = true;

    public $sms, $recipients;
    private $orange;
    private $limiter;
    private $sendingRate;
    private $startingTime;
    private $fundsProcessor;
    private $reportFrequency;

    public function __construct(Sms $sms, RecipientList $list)
    {   
        $this->sms = $sms;
        $this->recipients = $list;
        $this->reportFrequency = 1;
        $this->startTracking($this, $this->sms, 'rollouts');
        $this->fundsProcessor = new FundsProcessing();   
        $this->setProgressMax($this->recipients->entries);     
    }

    public function handle()
    {
        try{
            $this->prepareAbortionStatusPolling();
            $this->verifySufficientFunds();
            $this->jobStatus->markAsExecuting();
            $this->allocateSendingBandwidth();
            $this->prepareOrangeApi();
            $this->sendEmail(User::find($this->sms->user_id)->email,
                                 new RolloutBegun($this->sms));
            //-----------------------------
            $this->performRollout();
            //-----------------------------
            $this->billUser();
            $this->jobStatus->markAsFinished();
            $this->sms->update(['status' => Sms::Sent]);
            $this->sendEmail(User::find($this->sms->user_id)->email, 
                                 new CompletionEmail($this->sms));
        }catch(Throwable $e){
            $this->beforeFail($e);
            $this->fail($e);
        }
    }

    private function verifySufficientFunds(){  
        $payable = 0;
        $running = $this->getUserRunningTasks($this->sms->user_id);
        if(isset($running) && count($running)>0){
            foreach($running as $task){
                $payable += $task->progress_max;
            }
        }
        $payable += $this->recipients->entries;
        if(!($this->fundsProcessor->hasSufficientFunds($this->sms->user_id, $payable))){
            throw new Exception('Insufficient funds.');
        }
    }

    private function prepareAbortionStatusPolling(){
        $this->setAbortionThreshHold($this->progressMax);
        $this->setFrequency($this->progressMax);
    }

    private function prepareOrangeApi(){
        $token = Token::first();
        $this->orange = new Orange(array('token'=> $token->value));
    }

    private function allocateSendingBandwidth(){
        $this->allocateBandwidth($this->sms->job_id);
        $this->limiter = new RateLimiter($this->bandwidth, 1);
        $this->doSafetyPause();
    }

    private function performRollout(){
        $chunkFilter = new FileChunkReadFilter();
        $reader = FileProcessing::createReader($this->recipients->file_extension);
        $maxRows = FileProcessing::getMaxRowSnapShot($reader, $this->recipients->file_path);
        $reader->setReadFilter($chunkFilter);
        $startRow = $this->firstOrResume();        
        $this->startingTime = Carbon::now();
        for($startRow; $startRow <= $maxRows; $startRow += FileChunkReadFilter::chunkSize) {
            $chunkFilter->setRows($startRow);
            $spreadsheet = FileProcessing::loadFile($reader, $this->recipients->file_path);
            $this->validateAndSendSms($spreadsheet->getActiveSheet());
        }
    }

    private function validateAndSendSms($worksheet){
        foreach($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            foreach($cellIterator as $cell) {
                //rate limit
                $this->limiter->await();
                //send sms
                if(FileProcessing::isValidBwNumber(strval($cell->getValue()))){
                    $this->sendMessageTo(strval($cell->getValue()));
                    $this->incrementProgress();
                    $this->reportProgress($this->reportFrequency);
                }
                $this->checkForRolloutAbortionAndFail();
                $this->updateAPIToken();
                $this->updateSendingBandwidth();
            }
        }
    }

    private function sendMessageTo(String $number){
        if(\Config::get('app.env') == 'production'){
            $response = $this->orange->sendSms(
                'tel:+267'.Orange::API_NUMBER,
                'tel:+267'.substr($number, -8),
                $this->sms->message,
                $this->sms->sender
            );
            if(isset($response['error'])){
                throw new Exception($response['error']);
            }
        }
        
    }

    private function firstOrResume(){
        if($this->isNthAttempt()){
            return $this->progressNow > 0 ?
                $this->progressNow: 1;
        }
        return 1;
    }

    private function checkForRolloutAbortionAndFail(){
        if($this->progressNow <= $this->abortionThreshHold){
            if($this->isAborted($this->sms->id, $this->progressNow)){
                throw new Exception('Aborted by user.');
            }
        }
    }

    private function updateAPIToken(){
        if($this->progressNow % 3000 === 0){
            //if we sent 3000 texts
            //time = 10min/25min past(last retrieval) 
            //@rate:(5sms/2sms per second) respectively
            $this->orange->setToken(Token::first()->value);
        }
    }

    private function reportProgress($every){
        if($this->progressNow % $every === 0 || $this->progressNow === $this->progressMax){ 
            $this->calculateCurrentSendingRate();
            $jobInfo = [ 
                'smsId' => $this->sms->id,
                'userId' => $this->sms->user_id,
                'total' => $this->progressMax,
                'current' => $this->progressNow,
                'smsSender' => $this->sms->sender,
                'smsMessage' => $this->sms->message,
                'sendingRate' => $this->bandwidth,//sendingRate,
                'smsRecipientsName' => $this->recipients->name,
            ];
            //dispatch progress event
            ReportProgress::dispatch($jobInfo);
        }
    }

    private function calculateCurrentSendingRate(){
        //sent-items/time
        $rate = ($this->progressNow/$this->startingTime->floatDiffInSeconds());
        $this->sendingRate = intval($rate);
    }

    private function billUser(){
        if($this->progressNow > 0){
            $bill = $this->progressNow;
            if(isset($this->prevProgress)){
                if($this->prevProgress > 0)
                    $bill = $this->progressNow - $this->prevProgress;
                    $this->fundsProcessor
                        ->decrementUserFunds($this->sms->user_id, $bill, $this->sms->order_no);
            }else{
                $this->fundsProcessor
                    ->decrementUserFunds($this->sms->user_id, $bill, $this->sms->order_no);
            }
            
        }
    }

    private function beforeFail(Throwable $e){
        $this->billUser();
        $this->jobStatus->markAsFailed($e->getMessage());
        if($e->getMessage() !== 'Aborted by user.'){
            $this->sms->update(['status' => Sms::Failed]);
        }
        $this->sendEmail(User::find($this->sms->user_id)->email, new RolloutFailed($this->sms));
        //fire event
        RolloutComplete::dispatch($this->sms, $this->progressNow);
    }

    private function updateSendingBandwidth(){
        $currentBandwidth = $this->bandwidth;
        $this->allocateBandwidth($this->sms->job_id);
        if($currentBandwidth != $this->bandwidth){
            $this->limiter->setFrequency($this->bandwidth);
            $this->doSafetyPause();
        }
    }

    private function doSafetyPause(){
        usleep(mt_rand(1250000, 1500000));
    }
}
