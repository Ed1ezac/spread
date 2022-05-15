<?php

namespace App\Traits;

use App\Models\JobStatus;

trait DelegatesSendingBandwidth{
    protected $FULL_BANDWIDTH = 5;
    protected $BIG_BANDWIDTH = 3;
    protected $SMALL_BANDWIDTH = 2;

    protected $bandwidth;

    protected function allocateBandwidth($id){
        $thisJob = JobStatus::forJob( $id)->first();
        $otherJob = JobStatus::where([
            ['job_id', '!=', $id],
            ['queue', '=', 'rollouts'],
            ['status', '=',JobStatus::STATUS_EXECUTING]
            ])->first();
        
        if(isset($otherJob) && !empty($otherJob)){
            $this->bandwidth = $thisJob->created_at > $otherJob->created_at  ?
                $this->SMALL_BANDWIDTH : $this->BIG_BANDWIDTH;
        }else{
            $this->bandwidth = $this->FULL_BANDWIDTH;
        }
    }
}