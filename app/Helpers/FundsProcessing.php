<?php

namespace App\Helpers;

use App\Models\Funds;
use App\Models\Reserve;
use App\Models\FundsRecord;
use App\Models\ReserveRecord;
use Illuminate\Support\Facades\DB;

class FundsProcessing{

    private $reserve, $userFunds;
    private static $retryAttempts = 30;

    /**
    * The assumption is that a different user can be malicious
    * at the purchase/deduction so we need to explicitly pass the
    * ID of the User that should be billed.||thats probably wrong tho...
    **/
    public function hasSufficientFunds($userId, $minimum){
        return Funds::forUserId($userId)->first()->amount >= $minimum;
    }

    public function incrementUserFunds($userId, $amount,$ref, $ori = -1){
        DB::transaction(function() use ($userId, $amount, $ref, $ori) {
            $this->setReserve();
            $this->setUserFunds($userId);
            //--
            $this->reserve->decrement('amount', $amount);
            $this->userFunds->increment('amount', $amount);
            //
            $this->recordReserveDeductionEvent($amount);
            $this->postFundsRecord(FundsRecord::Purchase, $amount, $ref, $ori);

        }, self::$retryAttempts);

    }

    public function decrementUserFunds($userId, $amount, $ref, $ori = -1){
        DB::transaction(function() use ($userId, $amount, $ref, $ori) {
            $this->setUserFunds($userId);
            //
            $this->userFunds->decrement('amount', $amount);
            //
            $this->postFundsRecord(FundsRecord::Deduction, $amount, $ref, $ori);

        }, self::$retryAttempts);
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

    private function postFundsRecord($event,$amount, $order, $ori){
        $this->userFunds->stageRecord([
            'funds_id' => $this->userFunds->id,
            'user_id' => $this->userFunds->user_id,
            'order_no' => $order,          
            'event' => $event,
            'originator' => $ori,
        ]);
        $this->userFunds->setRecordAmount($amount);
    }
}