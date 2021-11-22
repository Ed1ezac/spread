<?php

namespace App\Traits;

use App\Models\JobStatus;

trait ResumesJobs{
    protected $progress;
    //if a job had previously failed but had some progress
    //it should begin from where it failed/stopped, not from scratch
    protected function hasPreviousProgress($job_id){
        $this->progress = Jobstatus::find($job_id)->progress;
        return isset($this->progress) && $this->progress > 0;
    }

}