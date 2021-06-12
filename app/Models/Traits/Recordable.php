<?php

namespace App\Models\Traits;

use App\Models\ReserveRecord;

trait Recordable{
    //
    public function recordEvent(array $data){
        ReserveRecord::create($data);
    }
}