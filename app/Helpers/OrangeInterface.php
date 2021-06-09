<?php

namespace App\Helpers;

use App\Models\Reserve;

class OrangeInterface{
    private const defaultSender = '13232';//todo

    private $sender, $message;

    public function sendSmsTo($number){

    }

    public function buySmsCredit(){
        //
    }

    public function setSender($sender = self::defaultSender){
        $this->sender = $sender;
    }

    public function setMessage($message){
        $this->message = $message;
    }

}