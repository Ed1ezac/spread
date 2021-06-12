<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    const Client = 'client';
    const Moderator = 'moderator';
    const Administrator = 'administrator';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //----Relationships!
    public function funds()
    {
        return $this->hasOne(Funds::class);
    }

    public function smses()
    {
        return $this->hasMany(Sms::class);
    }

    public function recipientLists()
    {
        return $this->hasMany(RecipientList::class);
    }

    public function jobStatuses()
    {
        return $this->hasMany(JobStatus::class);
    }
}
