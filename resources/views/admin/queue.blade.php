@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif

    <div class="flex flex-col items-center space-y-3 max-w-3xl rounded-lg bg-gray-800 py-8 px-16">
        @if(isset($queue) && count($queue)>0)
            @foreach ($queue as  $item)
                @if ($item->status == 'executing')
                    <div class="bg-primary-100 shadow rounded h-24 w-full px-4 py-2">
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <div class="flex items-baseline">
                                    <div class="text-gray-900 font-medium text-lg">{{App\Models\User::find($item->user_id)->name}}</div>
                                    <div class="ml-2 text-gray-600 font-medium text-sm">{{App\Models\Sms::find($item->trackable_id)->order_no}}</div>
                                </div>
                                <div class="text-sm text-gray-500 font-medium">0 out of {{$item->progress_max}} recipients</div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div>
                                    <div class="text-xs text-green-500 font-semibold tracking-wider">EXECUTING</div>
                                    <div class="text-xs text-gray-500 font-medium">Began: begins: {{Carbon\Carbon::createFromTimestamp($item->available_at)->toDateTimeString()}}</div>
                                </div>
                                <div class="flex justify-end">
                                    <form action="/sms/rollout/abort" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->trackable_id}}">
                                        <span class="sm:block">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                                ABORT
                                            </button> 
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white shadow rounded w-full h-16 px-4 py-2">
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <div class="flex items-baseline">
                                    <div class="text-gray-900 font-medium text-lg">{{App\Models\User::find($item->user_id)->name}}</div>
                                    <div class="ml-2 text-gray-600 font-medium text-sm">{{App\Models\Sms::find($item->trackable_id)->order_no}}</div>
                                </div>
                                <div class="text-sm text-gray-500 font-medium">0 out of {{$item->progress_max}} recipients</div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex flex-col justify-center items-end">
                                    <div class="text-xs text-gray-500 font-semibold tracking-wider">QUEUED</div>
                                    <div class="text-xs text-gray-500 font-medium">begins: {{Carbon\Carbon::createFromTimestamp($item->available_at)->toDateTimeString()}}</div>
                                </div>
                                <div class="flex justify-end">
                                    <form action="/sms/rollout/abort" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->trackable_id}}">
                                        <span class="sm:block">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                                ABORT
                                            </button> 
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endif    
            @endforeach
        @else
            <div class="text-3xl leading-7 tracking-wider text-gray-50 self-senter my-32">Queue Empty . . .</div>
        @endif
    </div>
@endsection