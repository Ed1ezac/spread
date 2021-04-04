@extends('layouts.landing-header')

@section('content')
<section class="pt-20">
    <div class="flex justify-center sm:mt-8 2xl:mt-14">
    <div class="bg-white shadow-md overflow-hidden w-full max-w-sm rounded-md">
            <h3 class="text-gray-700 text-lg flex justify-content-center font-medium mx-6 mt-2 mb-3">Confirm your password to continue</h3>
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="px-6 py-2 space-y-6 sm:p-6">                    
                    <div>
                        <label for="password" class="block text-md font-medium text-gray-800">
                        Password
                        </label>
                        <password-field></password-field>
                    </div>
                    <div class="flex justify-end items-center">
                        <a class="font-semibold text-gray-700" href="{{ route('password.request') }}">Forgot your password?</a>
                    </div>
                    <!---button-->
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 border border-transparent text-sm tracking-wider font-bold  rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        CONFIRM PASSWORD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</!--div -->
