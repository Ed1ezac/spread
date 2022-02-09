@extends('layouts.landing-header')

@push('page-css')
<style>
    .extra-data {
        display:none;
    }
</style>
@endpush

@section('content')
<section class="pt-20 pb-10">
    <div class="flex justify-center 2xl:mt-14">
        <div class="bg-white shadow-md overflow-hidden w-full max-w-sm rounded-md mx-6 sm:mx-0">
            <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Get Started!</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="px-6 py-2 space-y-6 sm:p-6">
                    <div>
                        <label for="name" class="my-form-label">
                        Full Name
                        </label>
                        <input type="text" name="name" id="name" autocomplete="name" required value="{{ old('name') }}" class="w-full my-form-input 
                        @error('name') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                            @error('name')
                            <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="extra-data">
                        <label for="birthday">Birthday</label>
                        <input type="text" name="birthday" id="birthday" value="" />
                    </div>
                    <div>
                        <label for="user_name" class="my-form-label">
                        Email
                        </label>
                        <input type="email" name="email" id="email" autocomplete="email" required value="{{ old('email') }}" class="w-full my-form-input 
                        @error('email') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
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
                        <label for="password_confirmation" class="my-form-label">
                        Confirm Password
                        </label>
                        <password-field name="password_confirmation"></password-field>
                    </div>
                    <div class="inline-flex items-center">
                        <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-accent-800 focus:ring-2 focus:ring-accent-800 border-gray-300 rounded" required>
                        <label for="terms" class="ml-2 text-sm my-form-label">
                            I agree to the 
                                <span>
                                    <a href="/terms" class="text-accent-800 underline font-semibold hover:text-accent-500">terms</a>
                                </span> and 
                                <span>
                                <a href="/privacy" class="text-accent-800 underline font-semibold hover:text-accent-500">privacy policy</a>
                                </span>
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            REGISTER
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
