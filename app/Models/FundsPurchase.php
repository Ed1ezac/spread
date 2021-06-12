<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundsPurchase extends Model
{
    //amount is not mass-assignable
    protected $fillable = ['user_id', 'funds_id'];

}