@extends('layouts.admin-header')

@section('features')

<div class="flex flex-wrap">
    <div class="shadow-md ml-6 w-96 mb-4 border bg-white border-gray-50 rounded">
        <div class="flex justify-between items-center mx-2">
            <h3 class="my-2 text-sm text-gray-800 font-medium">Rollout Task</h3>
            <div>
                @if($task->status == 'failed')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                    {{$task->status}}
                </span>
                @elseif($task->status == 'finished')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{$task->status}}
                </span>
                @elseif($task->status == 'executing' || $task->status == 'retrying')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                    {{$task->status}}
                </span>
                @elseif($task->status == 'queued')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                    {{$task->status}}
                </span>
                @endif
            </div>
        </div>
        <div class="divide-y divide-dashed divide-gray-300">
            <div class="space-y-2 mb-1">
                <div class="m-2 flex justify-between">
                    <div class="text-xs text-gray-500">Attempts:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">{{$task->attempts}}</div>
                </div>
                <div class="m-2 flex justify-between">
                    <div class="text-xs text-gray-500">Sent To:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">{{$task->progress_now}}</div>
                </div>
                <div class="m-2 flex justify-between">
                    <div class="text-xs text-gray-500">Out of:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">{{$task->progress_max}}</div>
                </div>    
                <div class="m-2 flex justify-between">
                    <div class="text-xs text-gray-500">Started at:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                    {{$task->started_at == null ? '--:--' : $task->started_at->toDateTimeString()}}
                    </div>
                </div> 
                <div class="m-2 flex odd:bg-primary-200 justify-between">
                    <div class="text-xs text-gray-500">Finished at:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                    {{$task->finished_at == null ? '--:--' : $task->finished_at->toDateTimeString()}}
                    </div>
                </div>
                <div class="m-2 flex odd:bg-primary-200 justify-between">
                    <div class="text-xs text-gray-500">Rollout Time:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                        {{ ($task->finished_at == null || $task->started_at == null) ? 'pending..' : 
                            ($task->finished_at->diffInHours($task->started_at) > 0 ?
                            $task->finished_at->diffForHumans($task->started_at, true).' '.
                            $task->finished_at->diffForHumans($task->started_at->subHours(1), true)
                            :
                            $task->finished_at->diffForHumans($task->started_at, true))
                            }}
                    </div>
                </div>  
            </div>
            <div class="p-2 h-full">
            @if (isset($task->fail_error))
                <p class="text-xs text-gray-500">{{ $task->fail_error }}</p>
            @else
                <p class="text-xs italic text-gray-500">Failure notes appear here...</p>          
            @endif
            </div> 
        </div>                     
    </div>

    <div class="bg-white overflow-hidden rounded ml-6 w-80 mb-4 border border-gray-200">
        <div class="flex justify-between items-center mx-2">
            <h3 class="mt-2 ml-4 text-sm text-gray-800 font-medium">Sms Details</h3>
            <div>
                @if($sms->status == 'failed' || $sms->status == 'aborted')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                    {{$sms->status}}
                </span>
                @elseif($sms->status == 'sent')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{$sms->status}}
                </span>
                @elseif($sms->status == 'pending')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                    {{$sms->status}}
                </span>
                @endif
            </div>
        </div>
        <div class="px-4 pt-2 pb-3 space-y-4 sm:p-6">
            <div class="flex items-center">
                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <div class="flex w-full items-center justify-between">
                    <h3 class="text-base font-bold ml-3 text-gray-600">{{$sms->sender}}</h3>
                    <div class="text-xs font-semibold text-gray-500">{{$sms->order_no}}</div>
                </div>
            </div>
            <div class="flex h-24">                 
                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <div class="bg-gray-200 ml-2 px-2 p-1 w-60 border-gray-400 border-2">
                    <p class="font-medium text-sm text-gray-800">{{ $sms->message }}</p>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="flex flex-wrap">
    <div class="mt-4">
        <div class="ml-6 flex-shrink bg-white border border-gray-200 rounded-md w-80 md:mr-2">
            <h3 class="mt-2 ml-4 text-sm text-gray-800 font-medium">Sending User</h3>
            <div class="px-6 pb-4 space-y-5">
                <div class="pt-4 flex items-center">
                    <div class="w-12 h-12 relative mb-4">
                        <div class="w-full h-full bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                            <span class="table-cell text-white font-bold align-middle">{{ $user->initials }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-base font-medium text-gray-900">
                        {{$user->name}}
                        </div>
                        <div class="text-sm text-gray-500">
                        {{$user->email}}
                        </div>
                        <div class="text-xs mt-1 font-bold text-gray-500">
                        FUNDS: &nbsp <span class="text-gray-800">{{' '.$user->funds->amount}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($task->status == 'executing' || $task->status == 'retrying')
        <div class="mt-4 ml-6 ">
            <form action="/admin/rollout-tasks/abort" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$sms->id}}"/>
                <div class="rounded-md shadow w-80">
                    <button type="submit" class="w-full flex font-headings shadow-md tracking-wider font-bold items-center justify-center px-8 py-3 border border-transparent text-base rounded-md text-white bg-primary-500 hover:bg-primary-700 md:py-4 md:text-lg md:px-10">
                    ABORT ROLLOUT
                    </button>
                </div>
            </form>    
        </div>
    @endif
</div>

@endsection