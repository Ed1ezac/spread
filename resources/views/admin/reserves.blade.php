@extends('layouts.admin-header')

@section('features')
    @if(isset($reserve))
        <div class="flex flex-wrap justify-between items-start">
            <div class="w-80">
                <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                        <div class="bg-accent-700 self-center border border-accent-700 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">{{$reserve->name.' reserve'}}</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $reserve->amount.' '}}<span class="text-gray-500 text-xs font-medium">smses left</span></p>
                        </div>
                        </div>
                        <div class="self-start">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{$reserve->status}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/admin/funds-reserve/edit" class="inline-flex mt-2 sm:mt-0 items-center uppercase tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Edit Reserve
            </a>
        </div>
        @if(isset($history) && count($history)>0)
        <div class="mr-4 xl:mr-6 mt-8 xl:mt-10 mb-8">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="max-w-7xl shadow overflow-hidden border-b border-gray-200 sm:rounded">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Activity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Time
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($history as $record)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0">
                                            <div class="w-full h-full bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                                                <span class="table-cell text-sm text-white font-bold align-middle">{{ (\App\Models\User::find($record->triggering_user_id))->initials }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{$record->name}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($record->event == 'deduction')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                        {{$record->event}}
                                </span>
                                @elseif($record->event == 'increment')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$record->event}}
                                </span>
                                @endif
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-800">{{$record->amount}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if((\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at))->diffInDays() < 1 )
                                    <div class="text-sm text-gray-500">
                                        {{(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at))->diffForHumans()}}
                                    </div>
                                    @else
                                    <div class="text-sm text-gray-500">
                                        {{(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at))->toDayDateTimeString()}}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="px-4 py-2">{{ $history->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @else
    <div>
        <div class="ml-12 flex">
            <div class="mt-32 mb-12">
                <h3 class="text-3xl text-gray-700">Create a Reserve</h3>
                <p class="text-gray-500 mt-1">A reserve will hold all the available smses for the clients to pool from when they purchase smses.</p>
                <span class="sm:block mt-3">
                    <a href="/admin/funds-reserve/create" class="inline-flex items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        CREATE RESERVE 
                    </a>
                </span>
                
            </div>
            <div class="hidden sm:block ml-8 mt-8">
                <svg class="transform -rotate-12 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'funds-reserve' ? 2:1" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
            </div>
        </div>
    </div>
    @endif    
@endsection

@push('page-js')
@endpush