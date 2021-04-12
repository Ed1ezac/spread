@extends('layouts.dashboard-header')

@section('features')
    <h3 class="text-lg ml-4 font-bold leading-6 text-gray-900">Upload a new recipient list</h3>
    <form action="{{ route('upload-list') }}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="shadow-sm mx-4 mt-1 mb-4 max-w-2xl overflow-hidden border border-gray-200 sm:rounded-sm">
          <div class="px-6 py-2 space-y-6 sm:p-6">
            <div>
              <label for="collection_name" class="my-form-label">
                Collection Name
              </label>
              <input type="text" name="collection_name" id="collection_name" value="{{ old('collection_name') }}" autocomplete="list-name" 
                class="block w-full rounded border-gray-200
                focus:border-gray-200 focus:ring-2 focus:ring-offset-0 focus:ring-accent-800 
                @error('collection_name') bg-red-100 border-red-400 focus:ring-red-400 @enderror"/>
                @error('collection_name')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!--upload-->
            <div>
              <file-upload-field></file-upload-field>
              @error('data-file')
                <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div> 
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          <button type="submit" class="inline-flex justify-center py-2 px-4 border-primary-500 shadow-md my-btn bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            UPLOAD
          </button>   
        </div>
      </div>
    </form>
@endsection