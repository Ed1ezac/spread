<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Deductible;
use App\Models\Traits\Purchasable;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    use Purchasable, Deductible;
    //relo
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
