@extends('layouts.dashboard-header')

@section('features')
    <h3 class="text-lg font-bold leading-6 text-gray-900">Register a new sender name</h3>
    <form action="{{ route('register-sender-name') }}" method="POST">
        @csrf
        <div class="space-y-8 max-w-md">

            <!--Sender Name-->
            <div>
                <input type="text" name="sender-name" value="{{ old('sender-name') }}" autocomplete="sender-name" placeholder="Sender Name" required class="w-full font-bold my-form-input 
                    @error('sender-name') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                @error('sender-name')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!--Reason-->
            <div>
                <textarea maxlength="180" name="reason"  autocomplete="reason" placeholder="Briefly explain why you require a unique sender name." required class="w-full font-medium my-form-input
                 @error('reason') bg-red-200 border-red-400 focus:ring-red-400 @enderror">{{ old('reason') }}</textarea>
                 @error('reason')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!--Company Name-->
            <div>
                <input type="text" name="company-name" value="{{ old('company-name') }}" autocomplete="company-name" placeholder="Company Name" required class="w-full font-bold my-form-input 
                @error('company-name') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                @error('company-name')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!--Address-->
            <div>
                <input type="text" name="company-address" value="{{ old('company-address') }}" autocomplete="company-address" placeholder="Company Address" required class="w-full font-bold my-form-input 
                @error('company-address') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                @error('company-address')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!--Tax Number-->
            <div>
                <input type="text" name="tax-number" value="{{ old('tax-number') }}" id="tax-number" autocomplete="company-tax-number" placeholder="Tax Number" required class="w-full font-bold my-form-input 
                @error('tax-number') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                @error('tax-number')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!--Contact Number--->
            <div>
                <input type="tel" name="contact" value="{{ old('contact') }}" id="contact" autocomplete="company-contact" placeholder="Contact Number" required class="w-full font-bold my-form-input 
                @error('contact') bg-red-200 border-red-400 focus:ring-red-400 @enderror">
                @error('contact')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="max-w-md py-2 my-8">
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                Register
            </button>
        </div>
    </form>
@endsection