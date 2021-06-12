<?php

namespace App\Events;

use App\Models\Sms;
//use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportProgress implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $queue = 'reports';

    public $userId;
    public $total, $current;
    public $smsId, $smsSender, $smsMessage, $smsRecipients;

    public function __construct(array $jobInfo)
    {
        $this->smsId = $jobInfo['smsId'];
        $this->userId = $jobInfo['userId'];
        $this->total = $jobInfo['total'];
        $this->current = $jobInfo['current'];
        $this->smsSender = $jobInfo['smsSender'];
        $this->smsMessage = $jobInfo['smsMessage'];
        $this->smsRecipients = $jobInfo['smsRecipientsName'];
    }

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('rollouts.'.$this->userId);
    }
}
