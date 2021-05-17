<?php

namespace App\Events;

use App\Models\User;
use App\Models\RecipientList;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class FileProcessingComplete implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $list;
    public $user;
    public $queue = 'uploads';
   
    public function __construct(RecipientList $recipients)
    {
        $this->user = User::find($recipients->user_id);
        $this->list = $recipients;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('uploads.'.$this->user->id);
    }
}
