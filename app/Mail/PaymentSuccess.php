<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $cost;
    public $pdate;
    public $ptime;
    public $funds;
    public $username;
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($cost, $funds)
    {
        //
        $this->cost = $cost;
        $this->funds = $funds;
        $this->username = Auth::user()->name;
        $this->pdate = Carbon::now()->toDateString();
        $this->ptime = Carbon::now()->toTimeString();
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.payments.success');
    }
}
