@extends('layouts.dashboard-header')


@section('features')
<!--How much funds you have
    Add funds, request Refund
-->

<div class="container">
    <div class="shadow-sm overflow-hidden max-w-xs rounded-md">
        <div class="bg-gray-700 p-2 divide-y divide-gray-100">
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 transform -rotate-45 text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div class="flex-col ml-2">
                    <h5 class="text-lg text-white font-bold">Balance</h5>
                    <p class="text-white text-3xl font-medium">70'000 <span class="text-white text-xs font-bold">PULA</span></p>
                </div>
            </div>
            <div class="flex mt-1 pt-2">
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <p class="text-gray-500 text-xs ml-2 self-center">7'000'000 sms - <span class="font-bold text-gray-400">P0.15</span> / sms</p>
            </div>
        </div>
    </div>
    <!--funds pro's-->
    <div class="mt-10 flex flex-col space-y-7 sm:flex-row sm:space-y-0 sm:space-x-8">
        <div class="shadow-sm bg-white rounded-sm max-w-md">
            <div class="flex bg-blue-400 p-2 items-center">
                <svg class="flex-shrink-0 h-6 w-6 text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg ml-2 font-medium text-white">Funds</h3>    
            </div>
            <div class="flex-col space-y-2 px-2 py-3">
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-700 ml-2">Funds allow you to send bulk sms</p>
                </div>
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-700 ml-2">Add funds depending on the number of people you want to send sms to</p>
                </div>
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-700 ml-2">Once added, your funds will never expire.</p>
                </div>
            </div>
            <div class="p-2 flex justify-end">
                <a href="/funds/add" class="inline-flex items-center px-4 py-2 border-gray-300 my-btn text-gray-700 bg-gray-50 hover:bg-gray-400 hover:no-underline focus:outline-none focus:ring-gray-400">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ADD MORE FUNDS
                </a>
            </div>
        </div>

        <div>
            <div class="shadow-sm bg-white rounded-sm max-w-sm sm:block">
                <div class="flex bg-red-400 p-2 items-center">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg ml-2 font-medium text-white">Refunds</h3>    
                </div>
                <div class="flex-col space-y-2 px-2 py-3">
                    <div class="flex">
                        <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-gray-700 ml-2">Our system does not support refunds at the moment</p>
                    </div>
                    <div class="flex">
                        <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-gray-700 ml-2">To request a refund, you can <a href="#" class=""> contact us</a></p>
                    </div>
                    <div class="flex">
                        <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-gray-700 ml-2">Refunds may take time to process.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Empty view-->
<!--div class="">
    <div class="ml-12 flex">
        <div class="mt-32 mb-12">
            <h3 class="text-3xl text-gray-700">Add Some Funds</h3>
            <p class="text-gray-500 mt-1">You need funds in your account before you start sending bulk sms.</p>
            
            <span class="sm:block mt-3">
                <button type="button" class="inline-flex items-center px-4 tracking-wider py-2 border border-gray-300 rounded-sm shadow-md text-sm font-bold text-white bg-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ADD FUNDS
                </button>
            </span>
            
        </div>
        <div class="ml-12 mt-8">
            <svg class="transform -rotate-45 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
</!--div -->

@endsection