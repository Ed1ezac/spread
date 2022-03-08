<?php

namespace App\Traits;

use App\Models\JobStatus;

trait ResumesJobs{
    protected $prevProgress;
    //if a job had previously failed but had some progress
    //it should begin from where it failed/stopped, not from scratch
    protected function hasPreviousProgress($job_id){
        $this->prevProgress = Jobstatus::find($job_id)->progress_now;
        return isset($this->prevProgress) && ($this->prevProgress > 0);
    }

}