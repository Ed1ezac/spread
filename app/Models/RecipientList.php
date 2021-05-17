<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientList extends Model
{
    use HasFactory;
    //enum: 'status', ['processed', 'pending', 'invalid'] 
    protected $fillable = ['name', 'file_path','file_extension', 'entries', 'status','user_id'];
}
