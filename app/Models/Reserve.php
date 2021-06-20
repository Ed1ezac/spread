<?php

namespace App\Models;

use App\Traits\RecordsReservesEvents;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use RecordsReservesEvents;
    //status
    const Low = 'low';
    const Okay = 'okay';
    const Critical = 'critical';

    protected $fillable = ['name'];

    protected $hidden = ['amount'];

}
