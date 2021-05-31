<?php

namespace App\Models\Traits;

use App\Models\ReserveRecord;

trait Recordable{

    //
    protected $record;

    protected function recordEvent(array $data){
        $this->record = ReserveRecord::create($data);
    }
}