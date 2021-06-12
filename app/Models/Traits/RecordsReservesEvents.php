<?php

namespace App\Models\Traits;

use App\Models\ReserveRecord;

trait RecordsReservesEvents{
    //
    public function recordEvent(array $data){
        ReserveRecord::create($data);
    }
}