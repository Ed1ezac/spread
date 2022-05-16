<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class FundsRecord extends Model
{
    const Purchase = 'purchase';
    const Deduction = 'deduction';
    //'amount'
    protected $fillable = ['funds_id', 'user_id', 'event', 'originator', 'order_no'];

    public function scopeMine($query){
        return $query->where('user_id', Auth::id());
    }

    public function scopeWithOrderNo($query, $order){
        return $query->where('order_no', $order);
    }
}
