<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SenderName extends Model
{
    use HasFactory;
    const Pending = 'pending';
    const Approved = 'approved';
    const Rejected = 'rejected';

    protected $fillable = ['user_id','sender_name','status',
            'reason','company_name','company_address',
            'company_tax_number','company_contact_number'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
