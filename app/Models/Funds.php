<?php

namespace App\Models;

use App\Models\Traits\Deductible;
use App\Models\Traits\Purchasable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    use Purchasable, Deductible;
    //relo
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
}
