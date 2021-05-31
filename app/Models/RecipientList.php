<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientList extends Model
{
    //enums 
    const Pending = 'pending';
    const Invalid = 'invalid';
    const Processed = 'processed';
    
    protected $fillable = ['name', 'file_path','file_extension', 'entries', 'status','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
