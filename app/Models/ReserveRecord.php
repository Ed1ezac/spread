<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveRecord extends Model
{
    //use HasFactory;
    const Deduction = 'deduction';
    const Increment = 'increment';

    protected $fillable = ['reserve_id', 'triggering_user_id', 'event', 'amount'];
}
