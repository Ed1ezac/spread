@extends('layouts.landing-header')

@push('page-css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
@endpush

@section('content')
<section class="pt-20 mb-12 px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">What is Spread | Bulk SMS Service?</div>
    <p class="text-gray-500 mb-4">
        Spread is a web system that dispatches short message service (SMS) text to multiple recipients 
        in a single automated task.
    </p>
</section>
<section class="mb-12 px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">How Does Spread Work?</div>
    <p class="text-gray-500 mb-4">
        The Spread system accepts a file with a list of all the people to whom an SMS is to be sent and 
        sends the text to each valid mobile number found in that file in one iteration. After the User 
        registers an account and verifies their email address, they are required to add at least one file 
        with a list of properly obtained mobile phone numbers (as per our <a class="text-accent-800 hover:text-accent-500" href="/terms">Terms of Service</a>) 
        to receive SMS's. The user must then purchase SMS credit corresponding to the number of SMS's they 
        want to send. Finally, the user can compose the SMS and proceed to send it. A live rollout status is 
        displayed on the Statistics section of the user's dashboard.
    </p>
    <p class="text-gray-500 mb-4">
        The SMS sent will have a sender's name of <span class="font-bold">Spread</span>, unless the user 
        registers a unique Sender name and selects it before sending the SMS.
    </p>
</section>
<section class="px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">Pre-requisites</div>
    <p class="text-gray-500 mb-4">To send bulk SMS you need to:</p>

    <ul class="list-none list-inside mb-4 space-y-3 ml-8">
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Register an account on Spread.</p>
            </div>
        </li>
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Add a recipient list by uploading a data file.</p>
            </div>
        </li>
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Purchase SMS credit corresponding to the number of SMS to be sent.</p>
            </div>
        </li>
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Compose the SMS to be sent on the message creation form.</p>
            </div>
        </li>
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Select the recipient list you want to the send the text to.</p>
            </div>
        </li>
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Select the sender name that identifies your brand, if applicable.</p>
            </div>
        </li>
        <li>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-accent-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Review your message and send it. You may choose to delay sending your SMS.</p>
            </div>
        </li>
    </ul>
    

    <p class="text-gray-500 mb-4"></p>
</section>
<section class="px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">Recipient Lists</div>
    <p class="text-gray-500 mb-4">
        Spread allows its registered users to upload a file with a list of phone numbers of individuals who would like to receive 
        an SMS from the user. The file should be properly formatted as per its specific encoding scheme. When the user uploads the 
        file, our system will scan the file for all the mobile numbers it can find in the file and display that number upon completion. 
        That number will be a reference of how many SMS's you will be able to send to that particular Recipient List. When iterating through 
        the file, the system checks whether each mobile number is valid, that is, contains the right number of digits, begins with a seven for
        local (BW) numbers and other constraints. A row in the file should contain some data as completely blank rows may be detected as false
        positive inconsistencies and cause the whole file to be flagged as invalid.
    </p>
    <p class="text-gray-500 mb-4">The allowed file formats are:</p>
    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
        <li class="text-gray-500">.csv files</li>
        <li class="text-gray-500">.xls files</li> 
        <li class="text-gray-500">.xlsx files</li>
        <li class="text-gray-500">.txt files (formatted as csv data)</li>
    </ul>
    <em>
        <p class="text-gray-500 mb-4">NOTE: All information, mobile numbers or otherwise, contained in these uploaded files is never extracted from 
            the file itself and stored elsewhere within our system or any of our partners and members' systems. It remains in the file at all times 
            and is used in accordance with our <a class="text-accent-800 hover:text-accent-500" href="/privacy">Privacy Policy</a>.
        </p>
    </em>
</section>
<section class="px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">Composing The SMS</div>
    <p class="text-gray-500 mb-4">
        The user can compose an SMS on their dashboard on the SMS creation form. The form lets the user select 
        a sender name if they have one created, select the specific Recipient List they want to send to if they have multiple 
        lists and compose the message they want to send. Along with the constraints on our Terms of Service, the SMS text is subject 
        to a maximum length of 160 alphanumeric characters, including spacing.
    </p>
    <p class="text-gray-500 mb-4">The user can then save the SMS as a draft for later review or proceed to send it.</p>    
</section>
<section class="px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">Funds</div>
    <p class="text-gray-500 mb-4">
        Spread works on a pay as you go basis and charges only for what the user spends on the system. 
        Before sending a bulk SMS, the user must purchase SMS credit, referred to in the system as funds. When attempting to send 
        an SMS, the system first checks if the user's funds are sufficient enough to send the SMS to a specific Recipient List based 
        on the number of entries counted when the list was uploaded. If the funds are insufficient the rollout will fail without 
        sending any text. 
    </p>
    <p class="text-gray-500 mb-4">
        Funds are purchased by making an order via telephone or email. A bill of payment is then returned to the user with all the 
        payment methods accepted by the company. The bill is valid for a specific period of time and may be subject to cancellation. 
        The user can then proceed to pay the amount on the bill and have their accounted credited with the funds. Funds purchased in 
        this manner reflect on the user's account within 3 working days of payment confirmation.
    </p>
    <p class="text-gray-500 mb-4">Payment can be made by: </p>
    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
        <li class="text-gray-500">Bank transfer</li>
        <li class="text-gray-500">Cheque</li> 
        <li class="text-gray-500">Cash</li>
    </ul>
    <p class="text-gray-500 mb-4">
        Alternatively, the user can purchase SMS credit directly on the Spread web site under the Funds section. This is the quickest 
        method to purchase credit as the funds reflect on the user's account within 30 minutes of payment. The payment accepts 
        VISA and MasterCard credit/debit cards.
    </p>
    <p class="text-gray-500 mb-4">Refunds apply as per our <a class="text-accent-800 hover:text-accent-500" href="/refunds">Refunds Policy</a>.</p>
</section>
<section class="px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">SMS Rollouts</div>
    <p class="text-gray-500 mb-4">
        Once the SMS is validated for sending it is added to a rollout queue which works on a first come first serve basis. Our 
        system supports multi-channel sending, which means we can send several bulk SMSs simultaneously. The real-time progress of 
        the SMS rollout can be viewed on the Statistics section of the user's dashboard once sending begins. This display of progress
        contains other useful metrics such as the sending rate, the actual SMS being sent and the Recipient List it is being sent to. 
    </p>
    <p class="text-gray-500 mb-4">
        An SMS rollout can be aborted from the rollout progress widget. An SMS can only be aborted with 15% of the total progress or if 
        the number of sent SMS is less than 1500 for large rollouts.
    </p>
</section>
<section class="mb-8 px-8 lg:px-20">
    <div class="text-gray-700 text-2xl font-medium">Statistics</div>
    <p class="text-gray-500 mb-4">
        The Statistics section displays the active rollout progress of an SMS if there is one, but also shows the details of previously 
        sent SMS's. A detailed view of the rollout can be viewed with more information.
    </p>
</section>
@include('components.footer')
@endsection