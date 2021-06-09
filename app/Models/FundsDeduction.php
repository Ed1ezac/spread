<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundsDeduction extends Model
{
    //use HasFactory;
    protected $fillable = ['user_id', 'funds_id'];

}
