<?php

namespace App\Models;

use App\Models\RecipientList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sms extends Model
{
    /***
     * 'status'- enum with ONLY
     * 'draft', 'pending', 'sent', failed, aborted
     *  as possible entries
     */
    const Draft = 'draft';
    const Pending = 'pending';
    const Sent = 'sent';
    const Failed = 'failed';
    const Aborted = 'aborted';
    
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
