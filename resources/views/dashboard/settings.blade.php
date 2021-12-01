@extends('layouts.dashboard-header')

@section('features')
    
    <div class="pb-12">
    @if(isset($user))
        <div class="flex flex-wrap space-y-8">
            <!--personal-->
            <div class="bg-white shadow-md mt-8 overflow-hidden w-full max-w-md mr-10 rounded-md">
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

            <!---Sender name reg--->
            <div class="bg-white shadow-md relative mt-4 overflow-hidden w-full max-w-md mr-10 rounded-md">
                <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Sender Names</h3>
                @if(isset($senderNames) && count($senderNames)>0)
                <p class="text-gray-500 py-2 italic text-sm flex justify-center">you can register up to 3 sender names.</p>
                <div class="px-6 py-2 space-y-6 sm:p-6">
                    @foreach($senderNames as $name)
                    <div>
                        <div class="flex justify-between">
                            <div class="flex">
                                <div class="flex items-center h-5">
                                    @if($name->status == 'pending')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    @elseif($name->status == ' approved')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    @endif
                                </div>
                                <div class="ml-3 text-sm font-medium text-gray-700">
                                    {{$name->sender_name}}
                                    @if($name->status == 'pending')
                                    <p class="text-gray-500 italic">pending review</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex space-x-2 self-center">
                                <form method="POST" action="{{ route('delete-sender-name') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $name->id }}">
                                    <button type="submit" class="text-gray-500 hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class=""><!-- absolute bottom-4 left-6 right-6 -->
                    @if (count($senderNames) < 3)
                    <a href="/settings/register/new/sender-name" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        REGISTER NEW
                    </a>
                    @endif
                </div>
                </div>
                
                @else
                <div class="pl-6">
                    <div class="text-gray-700 text-center">
                        Register a sender name for free!
                    </div>
                    <div class="flex justify-between mt-2">
                        <div class="space-y-6 mt-2">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-medium text-gray-700">
                                    Completely free of charge
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-medium text-gray-700">
                                    Proper brand identity on texts
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-medium text-gray-700">
                                    Up to 3 sender names per account
                                </div>
                            </div>
                        </div>
                        <div class="-mr-3 -mt-3 text-gray-400">
                            <svg class="h-40 w-40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    @role('client')
                    <div class="pr-6">
                        <a href="/settings/register/new/sender-name" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            REGISTER NEW
                        </a>
                    </div>
                    @endrole
                </div>
                @endif
            </div>
            <!-- notif --->
            <div class="bg-gray-50 shadow-md overflow-hidden w-full max-w-md mr-10 rounded-md">
                <h3 class="text-gray-700 text-lg flex justify-center font-medium mx-6 my-2">Notifications</h3>
                <p class="text-gray-500 italic text-sm flex justify-center">sms notifications aren't supported yet.</p>
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