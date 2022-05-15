<?php

namespace App\Models;

use App\Models\Funds;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sms extends Model
{
    const Draft = 'draft';
    const Sent = 'sent';
    const Failed = 'failed';
    const Aborted = 'aborted';
    const Pending = 'pending';

    use softDeletes;
    
    protected $fillable = [
        'sender', 'message', 'status', 'order_no',
        'recipient_list_id', 'user_id', 'send_at',
    ];

    protected $casts = [
        'send_at' => 'datetime',
    ];


    public static function empty(){
        $sms = new Sms();
        $sms->sender = '';
        $sms->message = '';
        $sms->status = '';
        return $sms;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipients()
    {
        //BE CAREFUL-may not always resolve!
        return $this->hasOne(RecipientList::class);
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

    public function scopeWithOrderId($query, $order)
    {
        return $query->where('order_no', $order);
    }

}
