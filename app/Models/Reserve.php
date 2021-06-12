<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\RecordsReservesEvents;

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
