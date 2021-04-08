@extends('layouts.dashboard-header')

@section('features')
    @if (session('status')) 
    <notification-banner message="{{session('status') }}"></notification-banner>
    @endif
    <!--error-banner error="The quick brown fox saw this error!"></!--error-banner --->

    <div class="flex justify-between items-center mx-4">
      <h3 class="text-lg font-bold leading-6 text-gray-900">Recipients</h3>
      <a href="/recipients/add" class="inline-flex items-center px-4 py-2 border-gray-300 my-btn text-gray-700 bg-gray-50 hover:bg-gray-400 hover:no-underline focus:outline-none focus:ring-gray-400">
          <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          ADD A RECIPIENT LIST
      </a>
    </div>
    <div class="shadow-md mx-4 mt-2 max-w-4xl overflow-hidden border-b border-gray-200 sm:rounded-sm">
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
    </div>

    <div class="shadow-md ml-4 mt-4 p-2 w-20 bg-red-50 overflow-hidden rounded-md">
      <div class="flex justify-center flex-col">
        <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
        </svg>
        <div>
        <div class="flex">
          <h3 class="justify-self-center mt-1">Name</h3>
        </div>
        </div>
      </div>
    </div>
@endsection