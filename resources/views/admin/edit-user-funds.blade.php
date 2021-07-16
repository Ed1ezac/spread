@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if($error[0] !='amount')
            <error-banner error="{{$error}}"></error-banner>
            @endif
        @endforeach
    @endif
    <div>
        <div class="shadow-sm flex-shrink bg-white rounded-md w-96 md:mr-2">
            <form action="/admin/user/credit/funds" method="POST">
                @csrf
                <div class="px-6 pb-6 space-y-6 divide divide-y-2 divide-gray-100">
                    <div class="mt-4">
                        <div class="pt-4 flex items-center">
                            <div class="w-12 h-12 relative mb-4">
                                <div class="w-full h-full bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                                    <span class="table-cell text-white font-bold align-middle">{{ $user->initials }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-base font-medium text-gray-900">
                                {{$user->name}}
                                </div>
                                <div class="text-sm text-gray-500">
                                {{$user->email}}
                                </div>
                                <div class="text-xs mt-1 font-bold text-gray-500">
                                FUNDS: &nbsp <span class="text-gray-800">{{' '.$user->funds->amount}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="pt-4">
                            <label for="amount" class="my-form-label">
                            Amount
                            </label>
                            <input type="text" name="amount" value="{{ old('amount') }}" autocomplete="off" required class="w-full 
                                my-form-input @error('amount') bg-red-200 border-red-400 focus:ring-red-400 @enderror"/>
                                @error('amount')
                                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>
                    <input type="hidden" name="userId" value="{{$user->id}}"/>
                </div>
                <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                    <button type="submit" formaction="/admin/user/deduct/funds" class="inline-flex justify-center py-2 px-4 mr-2 my-btn border-gray-300 text-gray-700 bg-gray-50 hover:border-primary-500 hover:bg-primary-500 focus:ring-primary-800">
                        <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                        </svg>
                        DEDUCT
                    </button>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                        </svg>
                        CREDIT
                    </button>   
                </div>
            </form>    
        </div>
    </div>
@endsection
@push('page-js')

@endpush