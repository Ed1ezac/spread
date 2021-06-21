@extends('layouts.dashboard-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif
    <div class="pb-12">
    @if(isset($user))
        <div class="flex flex-wrap space-y-4">
            <!--personal-->
            <div class="bg-white shadow-md mt-4 overflow-hidden w-full max-w-md mr-6 rounded-md">
                <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Personal Info</h3>
                <form method="POST" action="/settings/update/personal-info">
                    @csrf
                    <div class="px-6 py-2 space-y-6 sm:p-6">
                        <div>
                            <label for="name" class="my-form-label">
                            Full Name
                            </label>
                            <input type="text" name="name" id="name" autocomplete="name" required value="{{ $errors->any() ? old('name') : $user->name }}" class="w-full my-form-input 
                            @error('name') bg-red-200 border-red-400 focus:ring-red-400 @enderror"/>
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
                            <input type="email" name="email" id="email" autocomplete="email" required value="{{ $errors->any() ? old('name') : $user->email }}" class="w-full my-form-input 
                            @error('email') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                                @error('email')
                                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                SAVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- notif --->
            <div class="bg-gray-50 shadow-md overflow-hidden w-full max-w-md mr-6 rounded-md">
                <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Notifications</h3>
                <p class="text-gray-500 italic text-sm flex justify-center">notifications aren't supported yet.</p>
                <form action="#">
                    <div class="px-6 py-2 space-y-6 sm:p-6">
                        <div>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input name="notify-start" type="checkbox" class="focus:ring-accent-200 h-4 w-4 text-accent-100 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="comments" class="font-medium text-gray-700">Rollout Start</label>
                                    <p class="text-gray-500">Get notified when a bulk sms rolout starts.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input name="notify-end" type="checkbox" class="focus:ring-accent-200 h-4 w-4 text-accent-100 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="comments" class="font-medium text-gray-700">Rollout End</label>
                                    <p class="text-gray-500">Get notified when a bulk sms rolout ends.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <!--- class="focus:ring-accent-500 h-4 w-4 text-accent-600 --->
                                    <input name="notify-fail" type="checkbox" class="focus:ring-accent-200 h-4 w-4 text-accent-100 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="comments" class="font-medium text-gray-700">Rollout Failure</label>
                                    <p class="text-gray-500">Get notified when a bulk sms rolout fails.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-200 hover:bg-primary-400 focus:outline-none focus:ring-primary-800">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                SAVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- passwords -->
            <div class="bg-white shadow-md overflow-hidden w-full max-w-md rounded-md">
                <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Security</h3>
                <form method="POST" action="/settings/update/security">
                    @csrf
                    <div class="px-6 py-2 space-y-6 sm:p-6">
                        <div>
                            <label for="old_password" class="my-form-label">
                            Old Password
                            </label>
                            <password-field name="old_password"></password-field>
                                @error('old_password')
                                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div>
                            <label for="password" class="my-form-label">
                            New Password
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
                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                SAVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="ml-12 mt-20 text-xl text-gray-700">Error retrieving user, session may have expired. Try logging in again.</div>
    @endif
    </div>

@endsection