@extends('layouts.dashboard-header')


@section('features')
  @if ($errors->any())
    @foreach ($errors->all() as $error)
    <error-banner error="{{$error}}"></error-banner>
    @endforeach
  @endif
  <sms-rollout-progress
    user-id="{{Auth::id()}}"
    v-bind:is-about-to-send="{{ json_encode($isAboutToSend) }}"
    v-bind:aborted = "{{ null !== Session::get('aborted') ? json_encode(Session::get('aborted')) : json_encode(false) }}"
    v-bind:max-progress = "{{ null !== Session::get('maxProgress') ? json_encode(Session::get('maxProgress')) : -1 }}"
  ></sms-rollout-progress>

  @if(isset($history) && count($history)>0)
  <div class="mr-4 xl:mr-6 xl:mt-10 mb-8">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="max-w-7xl shadow overflow-hidden border-b border-gray-200 sm:rounded">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                  Message
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                  Sent To
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                  Time
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($history as $sms)
              <tr>
                <td class="px-6 py-4 max-w-xs whitespace-nowrap">
                  <div class="text-sm truncate">
                  <a href="{{'/statistics/view/sms/'.$sms->id}}" class="text-gray-500 hover:underline font-medium hover:text-accent-800">{{$sms->message}}</a>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($sms->status == 'sent')
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{$sms->status}}
                  </span>
                  @elseif($sms->status == 'failed')
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                    {{$sms->status}}
                  </span>
                  @elseif($sms->status == 'aborted')
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                    {{$sms->status}}
                  </span>
                  @elseif($sms->status == 'pending')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-accent-100 text-accent-800">
                      {{$sms->status}}
                    </span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                 {{$sms->progress_now}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                      @if((\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sms->created_at)->diffInDays()) < 1 )
                      <div class="text-sm font-medium text-gray-900">
                        {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sms->created_at)->diffForHumans()}}
                      </div>
                      @else
                      <div class="text-sm font-medium text-gray-900">
                        {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sms->created_at)->toDayDateTimeString()}}
                      </div>
                      @endif
                  </div>
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
  @elseif (!($isAboutToSend))
  <div>
      <div class="ml-12 flex">
          <div class="mt-32 mb-12">
              <h3 class="text-3xl text-gray-700">Statistics</h3>
              <p class="text-gray-500 mt-1">This is where you will be able to see realtime sms rollout progess and 
                        your previously sent smses along with their details. Go ahead and create an sms to get started.</p>
              <span class="sm:block mt-3">
                  <a href="/create" class="inline-flex items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                      <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                      </svg>
                      CREATE SMS 
                  </a>
              </span>
              
          </div>
          <div class="hidden sm:block ml-8 mt-8">
              <svg class="transform -rotate-12 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
          </div>
      </div>
  </div>
  @endif
  
@endsection
@push('page-js')
  <script>
      localStorage.removeItem('smsId');
      localStorage.removeItem('sendingDate');
      localStorage.removeItem('sendingTime');
  </script>    
@endpush