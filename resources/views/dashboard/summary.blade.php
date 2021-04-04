@extends('layouts.dashboard-header')

@section('features')
    <!---
    the message/preview
    the recipient list
    the capacity and funds
    the sending action - 'now/later/save as draft'
    --->
    <div class="flex space-x-4">
        <div class="shadow-sm overflow-hidden rounded-sm max-w-xl border-t-4 border-gray-500">
            <div class="bg-white px-4 pt-2 pb-3 space-y-4 sm:p-6">
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-base font-bold ml-2 self-center text-gray-600">MOHW</h3>
                </div>
                <div class="flex">                 
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <div class="bg-gray-300 ml-2 rounded-md p-2">
                        <p class="font-medium text-sm">Lorem ipsum dolor sit amet is a placeholder 
                        text that was made in the 1600s to sample types for printing.</p>
                    </div>
                </div>
                <div class="flex"> 
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-gray-400 self-center ml-2 text-base font-medium">Recipients List 1</p>
                </div>
                <div class="flex"> 
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-600 ml-2 self-center"><span class="font-bold">01</span>:<span class="font-bold">30</span>:<span class="font-bold">42</span></p>
                </div>
                <!--send options-->
                <fieldset>
                    <div class="mt-1">
                        <div class="flex items-center">
                        <input id="send_immediately" name="send_immediately" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300"/>
                        <label for="send_immediately" class="ml-3 pt-1 block text-sm font-medium text-gray-700">
                            Send immediately
                        </label>
                        </div>
                        <div class="flex items-center">
                        <input id="send_later" name="send_later" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
                        <label for="send_later" class="ml-3 block mt-1 text-sm font-medium text-gray-700">
                            Start sending at:
                        </label>
                        </div>
                        <div>
                        <datepicker>
                        </datepicker>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                <div>
                    <button class="inline-flex tracking-wider justify-center items-center py-2 px-4 text-sm font-bold rounded-sm text-gray-500 bg-gray-50 hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        <svg class="mr-1 h-5 flex-shrink-0 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        EDIT
                    </button> 
                </div>
                <div>
                    <button class="inline-flex tracking-wider justify-center py-2 px-4 mr-2 text-sm font-bold rounded-sm text-blue-400 bg-blue-50 hover:bg-blue-200 focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">
                        <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        SAVE DRAFT
                    </button> 
                    <button class="inline-flex tracking-wider justify-center py-2 px-4 shadow-md text-sm font-bold rounded-sm text-white bg-gray-600 hover:bg-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        CONFIRM
                    </button>   
                </div>  
            </div>
        </div>

        <div class="w-64">
            <div class="bg-yellow-100 rounded-sm p-2">
                <h3 class="text-gray-600 text-base">Billing</h3>
                <div class="mt-1 divide-y divide-gray-50">
                    <div class="flex flex-col">
                        <div class="flex justify-between items-center">
                            <p class="text-base text-gray-600">Funds</p>
                            <p class="text-lg text-green-600 font-semibold">P 70'000</p>
                        </div>
                        <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-600">@ P <span class="text-gray-800 font-bold">0.15 </span> / sms</p>
                        <p class="text-lg text-red-600 font-semibold">-P 60'000</p>
                        </div>
                    </div>
                    <div class="mt-1 flex justify-between items-center">
                        <p class="text-base text-gray-600">Bal</p>
                        <p class="text-lg text-gray-600 font-semibold">P 10'000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection