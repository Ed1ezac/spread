<?php

namespace App\Models;

use App\Models\RecipientList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sms extends Model
{
    /***
     * 'status'- enum with ONLY
     * 'draft', 'pending', 'sent'
     *  as possible entries 
     */
    protected $fillable = [
        'sender', 'message', 'status',
        'recipient_list_id', 'user_id', 'send_at'
    ];

    public function recipients()
    {
        return $this->hasOne(RecipientList::class);
    }

    protected $casts = [
        'send_at' => 'datetime',
    ];
}
