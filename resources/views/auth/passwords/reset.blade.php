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
    <div class="flex justify-center mb-12 sm:mt-14 2xl:mt-20">
        <div class="bg-white shadow-md overflow-hidden w-full max-w-sm rounded-md">
            <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Reset Password</h3>
            <form  method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="px-6 py-2 space-y-6 sm:p-6">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        <label for="email" class="my-form-label">
                        Email
                        </label>
                        <input type="email" name="email" autocomplete="email" required class="w-full my-form-input">
                        @error('email')
                        <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="my-form-label">
                        Password
                        </label>
                        <password-field name="password"></password-field>
                        @error('password')
                        <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="my-form-label">
                        Confirm Password
                        </label>
                        <password-field name="password_confirmation"></password-field>
                    </div>
                    
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        RESET PASSWORD
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>
@endsection

