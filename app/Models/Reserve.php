<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use Recordable;
    //status
    const Low = 'low';
    const Okay = 'okay';
    const Critical = 'critical';

    protected $fillable = ['name'];

    protected $hidden = ['amount'];
}
