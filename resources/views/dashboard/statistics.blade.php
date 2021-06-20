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
  ></sms-rollout-progress>

  @if(isset($history) && count($history)>0)
  <div class="mr-4 xl:mr-6 mt-8 xl:mt-10 mb-8">
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
                  <div class="text-sm truncate ">
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
  @endif
@endsection
@push('page-js')
  <script>
      localStorage.removeItem('smsId');
      localStorage.removeItem('sendingDate');
      localStorage.removeItem('sendingTime');
  </script>    
@endpush