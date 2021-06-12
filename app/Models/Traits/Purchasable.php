<?php

namespace App\Models\Traits;

use App\Models\FundsPurchase;


trait Purchasable{

    protected $fundsPurchase;

    public function stagePurchase(array $data){
        $this->fundsPurchase = FundsPurchase::create($data);
    }

    public function setPurchaseAmount($amount){
        $this->fundsPurchase->amount = $amount;
        $this->fundsPurchase->save();
    }
}