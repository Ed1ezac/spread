<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\RecordsFundsEvents;

class Funds extends Model
{
    use RecordsFundsEvents;
    //relo
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //scopes
    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function scopeForUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeWithId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeSufficient($query, $challenge)
    {
        return $query->where('amount', '>', $challenge);
    }
}
