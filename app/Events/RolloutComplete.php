<?php

namespace App\Events;

use App\Models\Sms;
use App\Models\User;
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
    public $user;
    public function __construct(Sms $sms)
    {
        $this->user = User::find($sms->user_id);
        $this->sms = $sms;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('rollouts');//PrivateChannel('channel-name');
    }
}
