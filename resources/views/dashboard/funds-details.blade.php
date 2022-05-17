@extends('layouts.dashboard-header')


@section('features')

<section class="flex flex-wrap">
    @if (isset($record))
        <div class="shadow-lg w-96 mr-16 mb-12 border pt-4 bg-white border-gray-50 rounded">
            <div class="flex justify-between items-center mx-2">
                <h3 class="my-2 text-sm text-gray-800 font-medium">Order Details</h3>
            </div>
            <div class="divide-y divide-dashed divide-gray-300">
                <div class="mx-2 pt-4 flex justify-between">
                    <div class="text-xs text-gray-500">Order:</div>
                    <div class="ml-12 text-xs text-accent-500 font-medium">
                        {{$record->order_no}}
                    </div>
                </div>
                <div class="mx-2 pt-4 flex justify-between">
                    <div class="text-xs text-gray-500">Event:</div>
                    @if($record->event == 'purchase')
                    <div class="ml-12 text-xs leading-5 font-bold text-green-600">
                        {{$record->event}}
                    </div>
                    @else
                        <div class="ml-12 text-xs leading-5 font-bold text-red-600">
                            {{$record->event}}
                        </div>
                    @endif
                </div>
                <div class="mx-2 pt-4 flex justify-between">
                    <div class="text-xs text-gray-500">Amount:</div>
                    <div class="ml-12 text-xs text-gray-800 font-bold">
                        {{$record->amount}} <span class="text-gray-600 font-normal">units</span>
                    </div>
                </div>
                <div class="mx-2 pt-4 flex justify-between">
                    <div class="text-xs text-gray-500">Originator:</div>
                    <div class="ml-12 text-xs text-gray-500 font-medium">
                    @if($record->originator > 0)
                        ADMINISTRATOR
                    @else
                        SYSTEM
                    @endif
                    </div>
                </div>
                <div class="mx-2 pt-4 pb-2 flex justify-between">
                    <div class="text-xs text-gray-500">Date:</div>
                    <div class="ml-12 text-xs text-gray-500 font-medium">
                        {{$record->created_at->toDayDateTimeString()}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($sms))
    <div class="border border-gray-200 mb-12 mr-16 overflow-hidden rounded w-96">
        <div class="bg-white px-4 pb-2 space-y-3 sm:p-4">
            <div class="flex items-center">
                <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                    <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold ml-3 text-gray-600">{{$sms->sender}}</h3>
            </div>
            <div class="flex h-16"> 
                <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                    <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <div class="bg-gray-100 ml-3 px-2 p-1 w-64 border-gray-300 border">
                    <p class="font-medium text-xs text-gray-800">{{ $sms->message }}</p>
                </div>
            </div>
            <div class="flex items-center"> 
                <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                    <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                @if(App\Models\RecipientList::find($sms->recipient_list_id) !== null)
                <div class="text-gray-500 ml-3 pt-1 text-xs font-medium">{{ App\Models\RecipientList::find($sms->recipient_list_id)->name.' - '. \App\Models\RecipientList::find($sms->recipient_list_id)->entries.' recipients' }}</div>
                @else
                <div class="bg-red-100 rounded text-red-400 ml-2 p-1 pt-1 text-xs">Recipients missing, may have beeen deleted.</d>
                @endif
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6">     
            <div class="flex justify-end">
                <div>
                    <span class="sm:block">
                        <a href="{{'/statistics/view/sms/'.$sms->id}}" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            VIEW SMS
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="mb-12 mr-16">
        @if(isset($sms))
            <div class="inline-flex bg-white h-20 border border-gray-100 mb-12 overflow-hidden rounded w-80">
                <div class="text-gray-500 text-sm p-4">
                    An amount of <span class="text-gray-700 font-semibold">{{$record->amount}}</span> 
                    units has been charged on your account for services.
                </div>
            </div>
        @elseif ($record->originator > 0)
            <div class="inline-flex bg-white h-20 border border-gray-100 mb-12 overflow-hidden rounded w-80">
                <div class="text-gray-500 text-sm p-4">
                    The Administrator has <span>{{ $record->event == 'purchase' ? 'credited':'charged' }}</span> 
                    your account with an amount of <span class="text-gray-700 font-semibold">{{ $record->amount }}</span> units.
                </div>
            </div>
        @else
            <div class="inline-flex bg-white h-20 border border-gray-100 mb-12 overflow-hidden rounded w-80">
                <div class="text-gray-500 text-sm p-4">
                    An amount of <span class="text-gray-700 font-semibold">{{$record->amount}} </span> 
                    units has been <span>{{ $record->event == 'purchase' ? 'credited to':'charged on' }}</span> your account for services.
                </div>
            </div>
        @endif
    </div>
</section>
    
@endsection