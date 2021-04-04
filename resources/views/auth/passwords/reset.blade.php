@extends('layouts.landing-header')

@section('content')
<section class="pt-20">
    <div class="flex justify-center sm:mt-14 2xl:mt-20">
        <div class="bg-white shadow-md overflow-hidden w-full max-w-sm rounded-md">
            <h3 class="text-gray-700 text-lg flex justify-content-center font-medium mx-6 my-2">Reset Password</h3>
            <form  method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="px-6 py-2 space-y-6 sm:p-6">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        <label for="user_name" class="my-form-label">
                        Email
                        </label>
                        <input type="text" name="user_name" id="user_name" autocomplete="user-name" required class="w-full my-form-input">
                    </div>
                    <div>
                        <label for="password" class="my-form-label">
                        Password
                        </label>
                        <password-field></password-field>
                    </div>
                    <div>
                        <label for="password" class="my-form-label">
                        Confirm Password
                        </label>
                        <password-field></password-field>
                    </div>
                    
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 border border-transparent text-sm tracking-wider font-bold  rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Reset Password
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section -->
@endsection

<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</!--div -->

