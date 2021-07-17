<?php

namespace App\Events;

use App\Models\Sms;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class ReportProgress implements ShouldBroadcastNow{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $total, $current, $sendingRate;
    public $smsId, $smsSender, $smsMessage, $smsRecipients;

    public function __construct(array $jobInfo)
    {
        $this->smsId = $jobInfo['smsId'];
        $this->userId = $jobInfo['userId'];
        $this->total = $jobInfo['total'];
        $this->current = $jobInfo['current'];
        $this->smsSender = $jobInfo['smsSender'];
        $this->smsMessage = $jobInfo['smsMessage'];
        $this->sendingRate = $jobInfo['sendingRate'];
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
