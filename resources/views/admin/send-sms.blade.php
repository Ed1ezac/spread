@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif

    <div>
        <div class="shadow-sm flex-shrink bg-white rounded-md w-96 md:mr-2">
            <form action="/admin/#" method="POST">
                    <div class="px-6 pb-6 divide-gray-100">
                        <div>
                            <div class="pt-4">
                                <label for="amount" class="my-form-label">
                                Send to
                                </label>
                                <input type="text" name="recipient" value="{{ old('recipient') }}" autocomplete="off" required class="w-full 
                                    my-form-input @error('recipient') bg-red-200 border-red-400 focus:ring-red-400 @enderror"/>
                                    @error('recipient')
                                    <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="pt-4">
                                <label for="amount" class="my-form-label">
                                Message
                                </label>
                                <textarea value="{{ old('message') }}" name="message" maxlength="140" rows="3" autocomplete="off" required class="w-full 
                                    my-form-input @error('message') bg-red-200 border-red-400 focus:ring-red-400 @enderror"></textarea>
                                    @error('amount')
                                    <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end px-4 py-3 bg-gray-50 sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                        </svg>
                        SEND
                    </button>   
                </div> 
            </form>
        </div>

@endsection

@push('page-js')
@endpush