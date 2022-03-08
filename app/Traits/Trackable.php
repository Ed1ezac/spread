<?php

namespace App\Traits;

use App\Models\JobStatus;

trait Trackable{
    protected $progressNow = 0;
    protected $progressMax = 0;
    
    protected $jobStatus;

    protected function startTracking($job, $model){
        $this->jobStatus = JobStatus::create([
            'job_id' => $model->job_id,
            'user_id' => $model->user_id,
            'trackable_id' => $model->id,
            'queue' => $job->queue,
            'attempts' => $job->attempts(),
        ]);
    }

    protected function setProgressMax($value)
    {
        $this->update(['progress_max' => $value]);
        $this->progressMax = $value;
    }

    protected function incrementProgress($offset = 1, $every = 1)
    {
        $value = $this->progressNow + $offset;
        $this->setProgressNow($value, $every);
    }

    protected function setProgressNow($value, $every = 1)
    {
        if ($value % $every === 0 || $value === $this->progressMax) {
            $this->update(['progress_now' => $value]);
        }
        $this->progressNow = $value;
    }

    public function isNthAttempt(){
        return $this->jobStatus->attempts > 0 && 
            $this->progressNow < $this->progressMax;
    }
    //should be private
    protected function update(array $data)
    {
        $this->jobStatus->update($data);
    }
}