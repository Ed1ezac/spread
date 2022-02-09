@extends('layouts.landing-header')

@section('content')
<div class="pt-20">
@if(session('status'))
    <notification-banner message="{{ session('status') }}"></notification-banner>
@endif
@if (session('resent'))
    <notification-banner message="{{ __('A fresh verification link has been sent to your email address.') }}"></notification-banner>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <error-banner error="{{$error}}"></error-banner>
    @endforeach
@endif
<section class="pt-20">
    <div class="flex flex-row justify-center">
        <div class="flex flex-col md:col-span-8">
            <div class="bg-white overflow-hidden rounded-md shadow-md px-2 mx-6 sm:mx-0">
            <h3 class="text-gray-700 text-lg flex justify-center font-headings font-medium mx-6 my-3">
            {{ __('Verify Your Email Address') }}
            </h3>
                
                <div class="mt-6 px-8">
                    
                    <div class="mt-4 mb-8 text-gray-500">
                        {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                        {{ __('If you did not receive the email, click the button below to request another link.') }}
                    </div>

                    <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                            {{ __('REQUEST VERIFICATION LINK') }}
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
