<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

trait SendsMail{

    protected function sendEmail($mail){
        Mail::to(Auth::user())->send($mail);
    }
}