@extends('layouts.dashboard-header')

@section('features')
  @if(session('status'))
    <notification-banner message="{{ session('status') }}"></notification-banner>
  @endif
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <error-banner error="{{$error}}"></error-banner>
    @endforeach
  @endif
  @if(isset($recipients) && count($recipients)>0)
    <div class="flex justify-between items-center mx-4">
      <h3 class="text-lg font-bold leading-6 text-gray-900">Recipients</h3>
      <a href="/recipients/add" class="inline-flex items-center px-4 py-2 border-gray-300 my-btn text-gray-700 bg-gray-50 hover:border-primary hover:bg-primary-500 focus:ring-primary-800 hover:no-underline focus:outline-none">
          <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          ADD A RECIPIENT LIST
      </a>
    </div>
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
            <span class="sm:block mt-3">
                <a href="/recipients/add" class="inline-flex items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ADD A RECIPIENT LIST 
                </a>
            </span>
            
        </div>
        <div class="ml-8 mt-8">
            <svg class="transform -rotate-12 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
  </div>
  @endif  

@endsection

<!---div class="shadow-md mx-4 mt-2 max-w-4xl overflow-hidden border-b border-gray-200 sm:rounded-sm">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Collection Name
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Capacity
          </th>
          <th scope="col" class="relative px-6 py-3">
              <span class="sr-only">Edit</span>
          </th>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr>
              <td class="px-6 py-2 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  Work Mates
                </div>
              </td>
              <td class="px-6 py-2 whitespace-nowrap">
              <div class="text-sm text-gray-900">9187 entries</div>
              </td>
              <td class="px-6 py-1 whitespace-nowrap text-right text-sm font-medium">
                  <div class="inline-flex items-center justify-items-end">
                      <a href="#" class="text-indigo-600">
                      <svg class="flex-shrink-0 h-5 w-5 text-blue-400 hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                      </svg>
                      </a>
                      <a href="#" class="ml-3">
                      <svg class="flex-shrink-0 h-5 w-5 text-red-400 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      </a> 
                  </div>
              </td>
          </tr>
          <tr>
              <td class="px-6 py-2 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  Invitees
                </div>
              </td>
              <td class="px-6 py-2 whitespace-nowrap">
              <div class="text-sm text-gray-900">11253 entries</div>
              </td>
              <td class="px-6 py-1 whitespace-nowrap text-right text-sm font-medium">
                  <div class="inline-flex justify-items-end">
                      <a href="#" class="text-indigo-600">
                      <svg class="flex-shrink-0 h-5 w-5 text-blue-400 hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                      </svg>
                      </a>
                      <a href="#" class="ml-3">
                      <svg class="flex-shrink-0 h-5 w-5 text-red-400 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      </a>
                  </div>
              </td>
          </tr>
        </tbody>
        </table>
    </!---div -->