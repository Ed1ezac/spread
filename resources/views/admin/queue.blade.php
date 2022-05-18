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
                    <div class="bg-white shadow rounded h-24 w-full px-4 py-2">
                        <div>
                            <div class="flex flex-col">
                                <div class="flex">
                                    <div class="text-gray-900 font-medium text-lg">{{App\Models\User::find($item->user_id)->name}}</div>
                                    <div class="text-gray-900 font-medium text-lg">{{App\Models\Sms::find($item->trackable_id)->order_no}}</div>
                                </div>
                                <div class="text-sm text-gray-500 font-medium">0 out of {{$item->progress_max}} recipients</div>
                            </div>
                            <div class="">
                                <div class="text-xs text-gray-500 font-semibold">EXECUTING</div>
                                <div class="text-xs text-gray-500 font-medium">started  3 hours</div>
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
                            <div class="">
                                <div class="text-xs text-gray-500 font-semibold">QUEUED</div>
                                <div class="text-xs text-gray-500 font-medium">begins in  3 hours</div>
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