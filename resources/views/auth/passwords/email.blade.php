@extends('layouts.landing-header')

@section('content')
<section class="pt-20">
@if(session('status'))
    <notification-banner message="{{ session('status') }}"></notification-banner>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <error-banner error="{{$error}}"></error-banner>
    @endforeach
@endif
<div class="flex justify-center sm:mt-14 2xl:mt-20">
        <div class="bg-white shadow-md overflow-hidden w-full max-w-sm rounded-md">
            <h3 class="text-gray-700 text-lg flex font-headings justify-center font-medium mx-6 my-2">Reset Password</h3>
            <form  method="POST"action="{{ route('password.email') }}">
                @csrf
                <div class="px-6 py-2 space-y-6 sm:p-6">
                    <div>
                        <label for="email" class="my-form-label">
                        Email
                        </label>
                        <input type="email" name="email" autocomplete="email" required class="w-full font-semibold my-form-input">
                        @error('email')
                        <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!---button-->
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </span>
                        SEND PASSWORD RESET LINK
                        </button>
                    </div>
                </div>
            </form>
            
        </div>

    </div>
</section>
@endsection
