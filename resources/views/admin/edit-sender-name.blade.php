@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif

    <div class="shadow-sm flex-shrink bg-white rounded-md w-96 md:mr-2">
        <form action="/admin/sender-name/edit/status/positive" method="POST">
            @csrf
            <div class="px-6 pb-6 space-y-6 divide divide-y-2 divide-gray-100">
                <div class="mt-4">
                    <div class="pt-4 flex items-center">
                        <div class="w-12 h-12 relative mb-4">
                            <div class="w-full h-full bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                                <span class="table-cell text-white font-bold align-middle">{{ $senderName->company_name[0] }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-base font-medium text-gray-900">
                                {{$senderName->company_name}}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{$senderName->company_address}}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{$senderName->company_contact_number}}
                            </div>
                            <div class="text-xs mt-1 font-bold text-gray-500">
                            TAX-No: &nbsp <span class="text-gray-800">{{' '.$senderName->company_tax_number}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4 space-y-4">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <h3 class="text-base font-bold ml-2 text-gray-600">{{ $senderName->sender_name }}</h3>
                    </div>
                    <div class="flex h-24">                 
                        <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <div class="bg-gray-200 w-full ml-2 px-2 p-1 border-gray-400 border-2">
                            <p class="font-medium text-sm text-gray-800">{{ $senderName->reason }}</p>
                        </div>
                    </div>
                    <div class="ml-8">
                        @if($senderName->status == 'pending')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-700">
                            {{$senderName->status}}
                        </span>
                        @elseif($senderName->status == 'approved')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{$senderName->status}}
                        </span>
                        @elseif($senderName->status == 'rejected')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                            {{$senderName->status}}
                        </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="sender_name_id" value="{{$senderName->id}}"/>
            </div>
            
            <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                <div>
                    @if($senderName->status != 'rejected')
                    <button type="submit" formaction="/admin/sender-name/edit/status/negative" class="inline-flex justify-center py-2 px-4 mr-2 my-btn border-gray-300 text-gray-700 bg-gray-50 hover:border-primary-500 hover:bg-primary-500 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                        </svg>
                        REJECT
                    </button>
                    @endif
                </div>
               
                <button type="submit" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                    </svg>
                    @if($senderName->status == 'pending')
                        APROVE
                    @else
                        STALL
                    @endif
                </button>
            </div>
        </form>
    </div>

@endsection