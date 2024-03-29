@extends('layouts.dashboard-header')


@section('features')
    <div class="flex flex-wrap">
        <div class="shadow-lg overflow-hidden rounded mb-4 mr-12 w-112 border-t-4 border-accent-600">
            <div class="bg-white px-4 pt-2 pb-3 space-y-4 sm:p-6">
                <div class="flex items-center">
                    <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                        <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="flex w-full items-center justify-between">
                        <h3 class="text-base font-bold ml-3 text-gray-600">{{$sms->sender}}</h3>
                        <div class="text-xs font-semibold text-gray-500">{{$sms->order_no}}</div>
                    </div>
                </div>
                <div class="flex h-24"> 
                    <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                        <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div class="bg-gray-200 ml-3 px-2 p-1 w-80 border-gray-400 border-2">
                        <p class="font-medium text-sm text-gray-800">{{ $sms->message }}</p>
                    </div>
                </div>
                <div class="flex"> 
                    <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                        <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    @if(isset($recipients))
                    <p class="text-gray-500 ml-3 pt-1 text-base font-medium">{{ $recipients->name.' - '.$recipients->entries.' recipients' }}</p>
                    @else
                    <p class="bg-red-100 rounded text-red-400 ml-2 p-1 pt-1 text-base font-medium">Recipients missing, may have beeen deleted.</p>
                    @endif
                </div>
                <div class="flex items-center">
                    <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                        <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        @if($sms->status == 'sent')
                            <span class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{$sms->status}}
                            </span>
                            @elseif($sms->status == 'failed')
                            <span class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                {{$sms->status}}
                            </span>
                            @elseif($sms->status == 'aborted')
                            <span class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                                {{$sms->status}}
                            </span>
                            @elseif($sms->status == 'pending')
                            <span class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-accent-100 text-accent-800">
                            {{$sms->status}}
                            </span>
                        @endif
                    </div>    
                </div>
            </div>
            <!-- for the future: --> 
            <div class="px-4 py-3 bg-gray-50 sm:px-6">     
                @if($sms->status == 'pending')
                <div class="flex justify-end">
                    <div>
                        <span class="sm:block">
                            <a href="/statistics" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                VIEW PROGRESS
                            </a>
                        </span>
                    </div>
                </div>
                @elseif($sms->status == 'aborted' || $sms->status == 'failed')
                <div class="flex justify-end">
                    <div>
                        <form class="" action="/statistics/delete/sms" method="POST">
                            @csrf  
                        <span class="sm:block">
                            <input type="hidden" name="id" value="{{$sms->id}}"/>
                            <button class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                                <svg class="flex-shrink-0 -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                DELETE
                            </button>   
                        </span>
                        </form>
                    </div>
                    <div class="hidden">
                        <span class="sm:block">
                            <button class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                                <svg class="-ml-1 mr-2 transform rotate-45 flex-shrink h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                RETRY
                            </button>   
                        </span>
                    </div>
                </div>
                @else
                <div class="flex justify-end">
                    <div>
                        <form class="" action="/statistics/delete/sms" method="POST">
                            @csrf  
                        <span class="sm:block">
                            <input type="hidden" name="id" value="{{$sms->id}}"/>
                            <button class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                                <svg class="flex-shrink-0 -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                DELETE
                            </button>   
                        </span>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @if(isset($details))
        <div class="w-72 mb-4 border border-gray-200 rounded">
            <h3 class="m-2 text-sm text-gray-800 font-medium">Rollout Stats</h3>
            
            <div class="divide-y divide-dashed divide-gray-300">
                <div class="space-y-2 mb-1">
                    <div class="m-2 flex justify-between">
                        <div class="text-xs text-gray-500">Attempts:</div>
                        <div class="ml-12 text-xs text-gray-700 font-medium">{{$details->attempts}}</div>
                    </div>
                    <div class="m-2 flex justify-between">
                        <div class="text-xs text-gray-500">Sent To:</div>
                        <div class="ml-12 text-xs text-gray-700 font-medium">{{$details->progress_now}}</div>
                    </div>
                    <div class="m-2 flex justify-between">
                        <div class="text-xs text-gray-500">Out of:</div>
                        <div class="ml-12 text-xs text-gray-700 font-medium">{{$details->progress_max}}</div>
                    </div>    
                    <div class="m-2 flex justify-between">
                        <div class="text-xs text-gray-500">Started at:</div>
                        <div class="ml-12 text-xs text-gray-700 font-medium">
                        {{$details->started_at == null ? '--:--' : $details->started_at->toDateTimeString()}}
                        </div>
                    </div> 
                    <div class="m-2 flex odd:bg-primary-200 justify-between">
                        <div class="text-xs text-gray-500">Finished at:</div>
                        <div class="ml-12 text-xs text-gray-700 font-medium">
                        {{$details->finished_at == null ? '--:--' : $details->finished_at->toDateTimeString()}}
                        </div>
                    </div>
                    <div class="m-2 flex odd:bg-primary-200 justify-between">
                        <div class="text-xs text-gray-500">Rollout Time:</div>
                        <div class="ml-12 text-xs text-gray-700 font-medium">
                            {{ ($details->finished_at == null || $details->started_at == null) ? 'pending..' : 
                               ($details->finished_at->diffInHours($details->started_at) > 0 ?
                                $details->finished_at->diffForHumans($details->started_at, true).' '.
                                $details->finished_at->diffForHumans($details->started_at->subHours(1), true)
                               :
                                $details->finished_at->diffForHumans($details->started_at, true))
                             }}
                        </div>
                    </div>  
                </div>
                <div class="p-2 h-full">
                @if (isset($details->fail_error))
                    <p class="text-xs text-gray-500">{{ $details->fail_error }}</p>
                @else
                    <p class="text-xs italic text-gray-500">Failure notes appear here...</p>          
                @endif
                </div> 
            </div>                     
        </div>
        @endif
    </div>
@endsection