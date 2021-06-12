@extends('layouts.admin-header')

@section('features')
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
        <a href="/admin/reserve/edit" class="inline-flex items-center uppercase tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Edit Reserve
        </a>
    </div>
@endsection

@push('page-js')
@endpush