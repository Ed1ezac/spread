<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class RecipientList extends Model
{
    //enums 
    const Pending = 'pending';
    const Invalid = 'invalid';
    const Processed = 'processed';
    
    protected $fillable = ['name', 'file_path', 'file_size','file_extension', 'entries', 'status','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function scopeWithId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
