<?php

namespace App\Helpers;

use App\Models\Funds;
use App\Models\Reserve;
use App\Models\ReserveRecord;
use Illuminate\Support\Facades\DB;

class FundsProcessing{

    private $reserve, $userFunds;
    private static $retryIncrementAttempts = 50;
    private static $retryDecrementAttempts = 5;

    /**
    * The assumption is that a different user can be authenticated
    * at the point of purchase/deduction so we need to explicitly pass the
    * ID of the User that should be billed.
    **/
    public function incrementUserFunds($userId, $amount){
        DB::transaction(function() use ($userId, $amount) {
            $this->setReserve();
            $this->setUserFunds($userId);
            //--
            $this->reserve->decrement('amount', $amount);
            $this->userFunds->increment('amount', $amount);
            //
            $this->recordReserveDeductionEvent($amount);
            $this->recordFundsPurchase($amount);

        }, self::$retryIncrementAttempts);

    }

    public function decrementUserFunds($userId, $amount){
        DB::transaction(function() use ($userId, $amount) {
            $this->setUserFunds($userId);
            //
            $this->userFunds->decrement('amount', $amount);
            //
            $this->recordFundsDeduction($amount);

        }, self::$retryDecrementAttempts);
    }

    private function setReserve(){
        $this->reserve = Reserve::find(1);
    }

    private function setUserFunds($id){
        $this->userFunds = Funds::forUserId($id)->first();
    }

    private function recordReserveDeductionEvent($amount){
        $this->reserve->recordEvent([
            'reserve_id' => 1, 
            'triggering_user_id' => $this->userFunds->user_id, 
            'event' => ReserveRecord::Deduction,
            'amount' => $amount
        ]);
    }

    private function recordFundsPurchase($amount){
        $this->userFunds->stagePurchase([
            'user_id' => $this->userFunds->user_id,
            'funds_id' => $this->userFunds->id,
        ]);
        $this->userFunds->setPurchaseAmount($amount);
    }

    private function recordFundsDeduction($amount){
        $this->userFunds->stageDeduction([
            'user_id' => $this->userFunds->user_id,
            'funds_id' => $this->userFunds->id,
        ]);
        $this->userFunds->setDeductionAmount($amount);
    }
}