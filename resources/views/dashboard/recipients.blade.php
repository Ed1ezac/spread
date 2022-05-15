@extends('layouts.dashboard-header')

@section('features')
  
  @if(isset($recipients) && count($recipients)>0)
    @if(count($recipients)<15)
      @role('client')
      <div class="flex justify-start sm:justify-end items-center mx-4">
        <a href="/recipients/add" class="inline-flex items-center px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            ADD A RECIPIENT LIST
        </a>
      </div>
      @endrole
    @endif
    <div class="flex flex-wrap">
      @foreach ($recipients as $list)
      <recipients-list
        v-bind:list="{{ json_encode($list) }}"
        user-id="{{Auth::user()->id}}"
      ></recipients-list>
      @endforeach
    </div>
  @else
  <div>
    <div class="ml-12 flex">
        <div class="mt-32 mb-12">
            <h3 class="text-3xl text-gray-700">Upload a list</h3>
            <p class="text-gray-500 mt-1">A Recipient List is a file that contains the phone numbers of the people who are going to recieve your bulk sms.</p>
            @role('client')
            <span class="sm:block mt-3">
                <a href="/recipients/add" class="inline-flex items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ADD A RECIPIENT LIST 
                </a>
            </span>
            @endrole
        </div>
        <div class="hidden sm:block ml-8 mt-8">
            <svg class="transform -rotate-12 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
  </div>
  @endif
@endsection