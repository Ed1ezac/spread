<?php

namespace App\Events;

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
    public $queue = 'fileprocessing';

    public $list;

    public function __construct(RecipientList $recipients)
    {
        $this->list = $recipients;
    }

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('uploads.'.$this->list->user_id);
    }
}
