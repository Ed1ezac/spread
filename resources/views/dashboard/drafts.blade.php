@extends('layouts.dashboard-header')

@section('features')
@if ($errors->any())
@foreach ($errors->all() as $error)
    <error-banner error="{{$error}}"></error-banner>
@endforeach
@endif
@if (isset($drafts) && count($drafts) > 0)
    <div class="flex flex-wrap">
    @foreach ($drafts as $sms)
        <draft-sms v-bind:sms="{{ json_encode($sms) }}"></draft-sms>
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
        <div class="hidden sm:block ml-8 mt-8">
            <svg class="transform -rotate-12 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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