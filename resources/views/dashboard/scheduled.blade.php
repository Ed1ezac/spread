@extends('layouts.dashboard-header')


@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif
    @if(isset($scheduled) && count($scheduled) > 0)
        <div class="flex flex-wrap">
        @foreach ($scheduled as $sms)
            <scheduled-sms
                v-bind:recipients="{{ json_encode(\App\Models\RecipientList::find($sms->recipient_list_id)) }}"
                v-bind:sms="{{ json_encode($sms) }}"
            >
            </scheduled-sms>
        @endforeach  
        </div>      
    @else
        <!--empty view-->
        <div class="">
            <div class="ml-12 flex">
                <div class="mt-32 mb-12">
                    <h3 class="text-3xl text-gray-700">Create a scheduled rollout</h3>
                    <p class="text-gray-500 mt-1">Scheduled message rollouts are created when you choose <span class="font-semibold">send later</span> on the summary page.</p>
                    
                    <span class="sm:block mt-3">
                        <a href="/create" class="inline-flex items-center tracking-widest px-4 py-2 my-btn shadow-md border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            CREATE SMS
                        </a>
                    </span>
                    
                </div>
                <div class="hidden sm:block ml-12 mt-8">
                    <svg class="transform rotate-45 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('page-js')
    <script>
        localStorage.removeItem('smsId');
        localStorage.removeItem('sendingDate');
        localStorage.removeItem('sendingTime');
    </script>
@endpush