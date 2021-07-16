@extends('layouts.admin-header')

@section('features')
    <div class="flex flex-wrap">
        <!--All-->
        <div class="w-80 m-2">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-accent-700 self-center border border-accent-700 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Total Smses</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $allSmses.' '}}<span class="text-gray-500 text-xs font-medium">sms</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Drafts-->
        <div class="w-80 m-2">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-accent-300 self-center border border-accent-300 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Drafts</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $drafts.' '}}<span class="text-gray-500 text-xs font-medium">sms</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Pending-->
        <div class="w-80 m-2">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-gray-500 self-center border border-gray-500 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Pending / Sending</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $pendingSmses.' '}}<span class="text-gray-500 text-xs font-medium">sms</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Sent-->
        <div class="w-80 m-2">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-green-500 self-center border border-green-500 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Sent</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $sentSmses.' '}}<span class="text-gray-500 text-xs font-medium">sms</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Failed-->
        <div class="w-80 m-2">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-red-500 self-center border border-red-500 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Failed</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $failedSmses.' '}}<span class="text-gray-500 text-xs font-medium">sms</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Aborted-->
        <div class="w-80 m-2">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-primary-500 self-center border border-primary-500 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Aborted</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $abortedSmses.' '}}<span class="text-gray-500 text-xs font-medium">sms</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="m-2 mb-8 text-sm">
        <div class="mr-4 xl:mr-6 mt-8 xl:mt-10">
            <div class="-my-2 sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="max-w-7xl shadow border-b border-gray-200 sm:rounded">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    User 
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Message (sms)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Created At
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($smses as $sms)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                        {{ (\App\Models\User::find($sms->user_id))->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs whitespace-nowrap">
                                        <div class="text-sm truncate">
                                            <a href="#" class="text-gray-500 hover:underline font-medium hover:text-accent-800">
                                                {{ $sms->message }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($sms->status == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-700">
                                                {{$sms->status}}
                                            </span>
                                            @elseif($sms->status == 'draft')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-accent-100 text-accent-700">
                                                {{$sms->status}}
                                            </span>
                                            @elseif($sms->status == 'sent')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{$sms->status}}
                                            </span>
                                            @elseif($sms->status == 'aborted')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-700">
                                                {{$sms->status}}
                                            </span>
                                            @elseif($sms->status == 'failed')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                                {{$sms->status}}
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(isset($sms->created_at) && $sms->created_at->diffInDays() < 1 )
                                        <div class="text-sm text-gray-500">
                                            {{ $sms->created_at->diffForHumans() }}
                                        </div>
                                        @elseif(isset($sms->created_at))
                                        <div class="text-sm text-gray-500">
                                            {{ $sms->created_at->toDayDateTimeString() }}
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-2">{{ $smses->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
@endpush