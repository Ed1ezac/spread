@extends('layouts.landing-header')

@push('page-css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
@endpush

@section('content')
<section class="pt-20">
    <div class="text-gray-700 text-center text-5xl font-medium m-12">Refund Policy</div>
    <div class="py-5">
        <div class="border-t-2 border-gray-200 mx-48 -mt-6"></div>
    </div>
    <div class="px-8 lg:px-20 space-y-12 mb-12">
        <div>
            <p class="text-gray-500 mb-4">
                Within thirty (30) calendar days of completing your payment for the Service, you may ask for a refund of your 
                Spread funds which were not spent during this period. In this case, you should specify the valid reason for a 
                refund in your request.
            </p>
            <p class="text-gray-500 mb-4">
                After the thirty-day period from the payment date, as well as in case of blocking your account due to the violation 
                of the Anti-Spam Policy or Terms of Use, the refund for paid but not used services is possible at Spread’s own discretion.
            </p>
            <p class="text-gray-500 mb-4">
                Email the support team at <a class="text-accent-800 hover:text-accent-500" href="mailto:support@spread.co.bw">support@spread.co.bw</a> 
                with the subject titled “Refund Request” to submit your request. Only requests submitted through this medium will be reviewed.
            </p>
            <p class="text-gray-500 mb-4">We typically review refund requests within seven (7) business days.</p>
        </div>
        <!---Requirements---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">Your Request Should Contain</div>
                <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                    <li class="text-gray-500">Submit a refund request using afore mentioned methods</li>
                    <li class="text-gray-500">Insert both order numbers. Firstly, specify the number of the order you need a refund for.</li>
                </ul>            
        </div>
        <!---Refund Process--->
        <div>
            <div class="text-gray-700 text-2xl font-medium">Refund Request Process</div>
            <p class="text-gray-500 mb-4">
                Each request is reviewed individually in the order of turn, and usually it takes up to seven (7) business days. 
                The support team will keep you updated on the status of your refund request.
            </p>
            <p class="text-gray-500 mb-4">
                Once your refund request has been approved, you will be informed by the support team about this. Please note that 
                it may take several weeks to process the refund depending on the payment method you used, your bank and other reasons beyond our control.
            </p>
        </div>
        <!---Duplicates--->
        <div>
            <div class="text-gray-700 text-2xl font-medium">Management of duplicate orders</div>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">Submit a refund request using afore mentioned methods</li>
                <li class="text-gray-500">Insert both order numbers. Firstly, specify the number of the order you need a refund for.</li>
            </ul>
            <p class="text-gray-700 font-bold mb-4">Note: Refund for the duplicate order is possible if you have not used the service</p>
        </div>
        <!---Right of Refusal---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">We reserve the right to refuse a refund</div>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">If the percentage of spam complaints from your subscribers exceeds 5% of all recipients on your recipient lists (but not less than 10 recipients).</li>
                <li class="text-gray-500">If no reasons for a refund are specified in the request.</li>
            </ul>
        </div>
        <!---Terms for Refund----->
        <div>
            <div class="text-gray-700 text-2xl font-medium">Terms of refund for cancelling your Spread account</div>
            <p class="text-gray-500 mb-4">
                We reserve the right to refuse any refund if your account is suspended or blocked due to spam complaints or abuse of bulk SMS.
            </p>
            <p class="text-gray-500 mb-4">
                Accounts with high level of spam complaints are blocked or suspended without the right to continue sending the SMS campaign.
            </p>
            <p class="text-gray-500 mb-4">
                We understand that there can be a certain number of complaints when you send bulk SMS messages. Thus, we specified 
                a permitted complaints level as around 2-5% per single SMS rollout. In addition, we take into consideration different 
                factors like the amount of sent SMS’s as well as complaints ratio and types of complaints. However, if your SMS campaign 
                gets a ratio that exceeds 5% of all recipients on your mailing list, we reserve the right to block or terminate your account without a refund.
            </p>
        </div>
    </div>
    @include('components.footer')
</section>
@endsection