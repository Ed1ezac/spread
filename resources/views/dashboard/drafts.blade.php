@extends('layouts.dashboard-header')

@section('features')
<!--
    show: text, recipient list, capacity, expected cost
-->
<!--Empty view-->
@if (isset($drafts) && count($drafts) > 0)
    <div class="grid grid-cols-1 xl:grid-cols-2">
    @foreach ($drafts as $sms)
    <div class="shadow-sm overflow-hidden rounded max-w-md mb-4 border-t-4 border-gray-500">
            <div class="bg-white px-4 pt-2 pb-3 space-y-4 sm:p-6">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-base font-bold ml-2 text-gray-600">{{ $sms->sender }}</h3>
                </div>
                <div class="flex">                 
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <div class="bg-gray-200 ml-2 pl-2 p-1 border-gray-400 border-2">
                        <p class="font-medium text-sm text-gray-800">{{ $sms->message }}</p>
                    </div>
                </div>
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-gray-500 ml-2 text-base font-medium">{{ App\Models\RecipientList::where('id', $sms->recipient_list_id)->first()->name }}</p><!---$sms->recipients()->name-->
                </div>
            </div>
            <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                <div>
                <span class="sm:block">
                        <button class="inline-flex justify-center py-2 px-4 my-btn border-transparent text-gray-700 bg-gray-50 hover:bg-gray-400 focus:ring-gray-300">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            DELETE
                        </button> 
                    </span>
                </div>

                <div class="flex">
                    <span class="sm:block">
                        <button class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            REVIEW
                        </button>   
                    </span>
                </div>  
            </div>
        </div>
    @endforeach
    <div>
@else
<div>
    <div class="ml-12 flex">
        <div class="mt-32 mb-12">
            <h3 class="text-3xl text-gray-700">Save a draft</h3>
            <p class="text-gray-500 mt-1">Drafts are created when you save an sms for later review on the sms creation wizard.</p>
            <span class="sm:block mt-3">
                <a href="/create" class="inline-flex items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    CREATE SMS 
                </a>
            </span>
            
        </div>
        <div class="ml-8 mt-8">
            <svg class="transform -rotate-12 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </div>
    </div>
</div>
@endif
@endsection