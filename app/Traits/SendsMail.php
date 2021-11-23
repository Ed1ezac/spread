<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

trait SendsMail{

    protected function sendEmail($email, $mail){
        Mail::to($email)->send($mail);
    }
}