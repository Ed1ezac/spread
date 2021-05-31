<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class FundsPurchase extends Model
{
    //use HasFactory;
    //amount not mass-assigned
    protected $fillable = ['user_id', 'funds_id'];

    protected function setAmount($amount){
        DB::transaction(function () use ($amount) {
            $this->amount += $amount;
            $this->save();
        }, 5);
    }
}