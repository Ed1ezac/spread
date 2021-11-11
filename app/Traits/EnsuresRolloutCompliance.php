<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\JobStatus;
use Illuminate\Support\Facades\Auth;

trait EnsuresRolloutCompliance{
    private $MAX_JOBS = 2;
    private $MIN_RATE = 2;

     //check we dont have MAX jobs currently running
    protected function isVacant()
    {
        $runningJobs = JobStatus::where('status', JobStatus::STATUS_EXECUTING)->count();
        return ($runningJobs < $this->MAX_JOBS);
    }
 
    //estimate how long it will take the jobs to finish
    protected function estimatedTimeTillVacant()
    {
        $estimate = $this->sumOfQueuedEntries();
        //2sms/second is worst case rate
        $estimate /= $this->MIN_RATE;
        return Carbon::now()->addSeconds(intval($remaining));
    }

    protected function isWithinTimeBounds()
    {
        //return time is between 0700 and 2130
        $startTime = Carbon::createFromTime(7,0,0);//0700hrs
        $endTime = Carbon::createFromTime(21,30,0);//2130hrs
        return Carbon::now()->isBetween($startTime,$endTime);
    }

    protected function userHasExecutingJob()
    {
        return JobStatus::where([
            ['status', '=', JobStatus::STATUS_EXECUTING ],
            ['user_id', '=', Auth::id()]
        ])->count() > 0;
    }

    protected function userHasCloselyQueuedJobs($sendsLater){
        $hasJob = false;
        if($sendsLater){
            $targetDateTime = Carbon::createFromFormat('d.m.Y H:i',
                    $request->input('day').''.$request->input('time')
                );
            
            $jobs = DB::table('jobs')->where([
                ['available_at', '>=', $targetDateTime->subHours(2)->timestamp],
                ['available_at', '<=', $targetDateTime->addHours(2)->timestamp]
            ])->get();
            //decode their payloads and sum recipients
            foreach($jobs as $job){
                $payload = json_decode($job->payload);
                $info = unserialize($payload->data->command);
                if($info->sms->user_id == $this->user()->id){
                    $hasJob = true;
                    break;
                }
            }
        }
        return $hasJob;
    }

    protected function rolloutWillCompleteInTime($numRecipients)
    {
        //check if the queued entries + requesting entry will execute in time
        //// by summing the recipient lists, dividing by min rate;
        $sum = $this->sumOfQueuedEntries();
        $sum += $numRecipients;
        $seconds = intval($sum / $this->MIN_RATE);

        $endTime = Carbon::createFromTime(21,30,0);
        $accumulatedTime = Carbon::now()->addSeconds($seconds);

        return $accumulatedTime->lessThan($endTime);
    }

    private function sumOfQueuedEntries()
    {
        $sum = 0;
        $executingSmsIds = array();

        $runningJobs = JobStatus::where('status', JobStatus::STATUS_EXECUTING)->get();
        foreach($runningJobs as $job){
            array_push($executingSmsIds, $job->trackable_id);
            $sum += ($job->progress_max - $job->progress_now);
        }
        //get all queued jobs
        $jobs = DB::table('jobs')->where([
            ['available_at', '>=', Carbon::createFromTime(7,0,0)->timestamp],
            ['available_at', '<=', Carbon::createFromTime(21,30,0)->timestamp]
        ])->get();
        //decode their payloads and sum recipients
        foreach($jobs as $job){
            $payload = json_decode($job->payload);
            $info = unserialize($payload->data->command);
            if(!empty($executingSmsIds) && in_array($info->sms->id, $executingSmsIds)){
                continue;
            }else{
                $sum += $info->recipients->entries;
            }
        }
        return $sum;
    }

}