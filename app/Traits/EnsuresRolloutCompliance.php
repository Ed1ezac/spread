<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\JobStatus;
use App\Models\RecipientList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait EnsuresRolloutCompliance{
    private $MAX_JOBS = 2;
    private $MIN_RATE = 2;

     //check we dont have MAX jobs currently running
    protected function isVacant()
    {
        $runningJobs = JobStatus::where([
            ['queue', '=', 'rollouts'],
            ['status','=', JobStatus::STATUS_EXECUTING]
        ])->count();
        return ($runningJobs < $this->MAX_JOBS);
    }
 
    //estimate how long it will take the jobs to finish
    protected function estimatedTimeTillVacant()
    {
        $estimate = $this->sumOfQueuedEntries(false, "");
        //2sms/second is worst case rate
        $estimate /= $this->MIN_RATE;
        return Carbon::now()->addSeconds(intval($estimate));
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
            ['queue', '=', 'rollouts'],
            ['status', '=', JobStatus::STATUS_EXECUTING ],
            ['user_id', '=', Auth::id()]
        ])->count() > 0;
    }

    protected function userHasCloselyQueuedJobs($sendsLater, $date){
        $hasJob = false;
        if($sendsLater){
            $targetDateTime = Carbon::createFromFormat('d.m.Y H:i', $date);
            
            $jobs = DB::table('jobs')->where([
                ['queue', '=', 'rollouts'],
                ['available_at', '>=', $targetDateTime->copy()->subHours(2)->timestamp],
                ['available_at', '<=', $targetDateTime->copy()->addHours(2)->timestamp]
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

    protected function rolloutWillCompleteInTime(array $request)
    {
        $numRecipients = RecipientList::find($request['recipient-list-id'])->entries;
        $sendsLater = $request['sending_time'] == 'later';
        $date = $sendsLater ? $request['day'].''.$request['time'] : "";
        //check if the queued entries + requesting entry will execute in time
        //// by summing the recipient lists, dividing by min rate;
        $sum = $this->sumOfQueuedEntries($sendsLater, $date);
        $sum += $numRecipients;
        $seconds = intval($sum / $this->MIN_RATE);

        $endTime = Carbon::createFromTime(21,30,0);
        $accumulatedTime = Carbon::now()->addSeconds($seconds);

        return $accumulatedTime->lessThan($endTime);
    }

    private function sumOfQueuedEntries($sendsLater, $date)
    {
        $sum = 0;
        $executingSmsIds = array();

        $runningJobs = JobStatus::where([
            ['queue', '=', 'rollouts'],
            ['status', JobStatus::STATUS_EXECUTING]
        ])->get();
        foreach($runningJobs as $job){
            if($runningJobs->isEmpty()) break;
            array_push($executingSmsIds, $job->trackable_id);
            $sum += ($job->progress_max - $job->progress_now);
        }
        
        //get all queued jobs for today, if sendsLater than today, get queued jobs for that day
        $jobs = $this->jobsForDay($sendsLater, $date);
        //decode their payloads and sum recipients
        
        foreach($jobs as $job){
            if($jobs->isEmpty()) break;
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

    private function jobsForDay($sendsLater, $date){
        $dt = (isset($date) && !empty($date)) ? 
            Carbon::createFromFormat('d.m.Y H:i', $date) :
            Carbon::now();
        if($sendsLater && !$dt->isToday()){
            return DB::table('jobs')->where([
                ['queue', '=', 'rollouts'],
                ['available_at', '>=', Carbon::create($dt->year, $dt->month, $dt->day, 7,0,0)->timestamp],
                ['available_at', '<=', Carbon::create($dt->year, $dt->month, $dt->day, 21,30,0)->timestamp]
            ])->get();
        }else{
            return DB::table('jobs')->where([
                //older than a day jobs wont be accounted for
                ['queue', '=', 'rollouts'],
                ['available_at', '>=', Carbon::createFromTime(7,0,0)->timestamp],
                ['available_at', '<=', Carbon::createFromTime(21,30,0)->timestamp]
            ])->get();
        }
    }

}