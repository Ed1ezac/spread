<?php

namespace App\Models\Traits;

use App\Models\FundsDeduction;

trait Deductible{

    protected $fundsDeduction; 

    public function stageDeduction(array $data){
        $this->fundsDeduction = FundsDeduction::create($data);
    }

    public function setDeductionAmount($amount){
        $this->fundsDeduction->amount = $amount;
        $this->fundsDeduction->save();
    }
}