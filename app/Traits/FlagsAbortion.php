<?php

namespace App\Traits;

use App\Models\Sms;
use Illuminate\Support\Facades\DB;

trait FlagsAbortion{
    protected $abortionThreshHold;
    protected $statusCheckFrequency = 1;

    protected function isAborted($id, $current){
        if($current % $this->statusCheckFrequency == 0 ){
            return (DB::table('sms')->find($id)->status === Sms::Aborted);
        }
        return false;
    }

    protected function setAbortionThreshHold($max){
        //15% of max Or 1500 people.
        $fifteenPercent = round((0.15 * $max));
        $fifteenPercent >= 1500 ? 
            $this->abortionThreshHold = 1500 : $this->abortionThreshHold = $fifteenPercent;
    }
   
    protected function setFrequency($max){
        if($max > 7000){
            $this->statusCheckFrequency = 2;
        }
    }
    
}