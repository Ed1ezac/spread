<?php

namespace App\Models\Traits;

use App\Models\FundsRecord;


trait RecordsFundsEvents{

    protected $fundsRecord;

    public function stageRecord(array $data){
        $this->fundsRecord = FundsRecord::create($data);
    }

    public function setRecordAmount($amount){
        $this->fundsRecord->amount = $amount;
        $this->fundsRecord->save();
    }
}