<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class FundsDeduction extends Model
{
    //use HasFactory;
    protected $fillable = ['user_id', 'funds_id'];

    protected function setAmount($amount){
        DB::transaction(function () use ($amount) {
            $this->amount -= $amount;
            $this->save();
        }, 5);
    }
}
