<?php

namespace App\Events;

use App\Models\Sms;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RolloutComplete implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $queue = 'rollouts';

    public $sms;
    public $sentSmsCount;
    public function __construct(Sms $sms, $numSent)
    {
        $this->sms = $sms;
        $this->sentSmsCount = $numSent;
    }

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(){
        return new PrivateChannel('rollouts.'.$this->sms->user_id);
    }
}
