<?php

namespace App\Mail;

use App\Models\Sms;
use App\Models\User;
use App\Models\RecipientList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RolloutComplete extends Mailable
{
    use Queueable, SerializesModels;

    protected $sms;
    protected $recipients;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
        $this->recipients = RecipientList::find($sms->recipient_list_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.rollouts.status', [
                        'username' => User::find($this->sms->user_id)->name,
                        'recipientsListName' => $this->recipients->name,
                        'entries' => $this->recipients->entries,
                        'text' => $this->sms->message,
                        'action' => 'completed successfully',
                        'status' => 'details'
                    ]);
    }
}
