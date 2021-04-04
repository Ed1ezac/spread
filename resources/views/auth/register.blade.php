@extends('layouts.landing-header')

@section('content')
<section class="pt-20 pb-10">
    <div class="flex justify-center 2xl:mt-14">
        <div class="bg-white shadow-md overflow-hidden w-full max-w-sm rounded-md">
            <h3 class="text-gray-700 text-lg flex justify-content-center font-medium mx-6 my-2">Get Started!</h3>
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
                        <password-field is-registration="y" confirmer=""></password-field>
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
                        <password-field is-registration="y" confirmer="y"></password-field>
                    </div>
                   
                    <!---button-->
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-gray-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <!-- Heroicon name: solid/lock-closed -->
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

<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</!--div -->
