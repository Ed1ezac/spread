<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsApiToken extends Model
{
    protected $table = "sms_api_token";

    protected $fillable = ['value'];

    
}
