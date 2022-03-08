<?php

namespace App\Mail\Inbound;

use BeyondCode\Mailbox\InboundEmail;
use BeyondCode\Mailbox\Facades\Mailbox;

class HandleEnquiriesEmail{

    public function __invoke(InboundEmail $email)
    {
        // Handle the incoming email
        //$email->reply(new EnquiryReceived);
        $email->forward('buffaloitbotswana@gmail.com');
    }

}