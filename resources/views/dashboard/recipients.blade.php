@extends('layouts.dashboard-header')

@section('features')
    <h3 class="text-lg ml-4 font-bold leading-6 text-gray-900">Recipients</h3>
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

    <p class="mt-4 ml-4 text-gray-500">Upload a new recipient list</p>
    <div class="shadow-sm mx-4 mt-1 mb-4 max-w-4xl overflow-hidden border border-gray-200 sm:rounded-sm">
      <form action="{{ route('upload-list') }}" method="POST">
        @csrf
        <div class="px-6 py-2 space-y-6 sm:p-6">
          <div>
            <label for="list_name" class="my-form-label">
              Collection Name
            </label>
            <input type="text" name="list_name" id="list_name" value="{{ old('list_name') }}" autocomplete="list-name" 
              class="block w-full rounded border-gray-200 
              focus:border-gray-200 focus:ring-2 focus:ring-offset-0 focus:ring-accent-800 
              @error('list_name') bg-red-100 border-red-400 focus:ring-red-400 @enderror"/>
              @error('list_name')
              <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <!--upload-->
          <div>
            <file-upload-field></file-upload-field>
          </div>
        </div> 
      </form>
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border-primary-500 shadow-md my-btn bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
          <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
          </svg>
          SAVE
        </button>   
      </div>
    </div>
@endsection