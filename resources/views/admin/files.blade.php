@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if($error[0] !='amount')
            <error-banner error="{{$error}}"></error-banner>
            @endif
        @endforeach
    @endif
    <div class="flex flex-wrap">
        <div class="w-80">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="bg-accent-700 self-center border border-accent-700 p-2 rounded">
                            <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="flex-col ml-3 pt-1">
                            <h3 class="text-xs text-gray-500 font-medium">Total Uploaded</h3>
                            <p class="text-gray-800 text-2xl font-bold">{{ $allFiles.' '}}<span class="text-gray-500 text-xs font-medium">files</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if(isset($files) && count($files)>0)
        <div class="mr-4 xl:mr-6 mt-8 xl:mt-10 mb-8">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="max-w-7xl shadow overflow-hidden border-b border-gray-200 sm:rounded">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Uploader (user)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    File Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Entries
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Size
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($files as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 font-medium truncate">
                                        {{ (\App\Models\User::find($file->user_id))->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 font-medium truncate">
                                            {{ $file->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-800 font-semibold">{{$file->entries}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-800 font-semibold">X KB</div>
                                    </td>
                                </tr>     
                            @endforeach
                            </tbody>
                        </table>   
                        <div class="px-4 py-2">{{ $files->links() }}</div> 
                    </div>
                </div>
            </div>
        </div>        
        @else
        <div class="text-gray-600 font-medium text-base">
            No Files Uploaded Yet...
        </div>
        @endif
        
    </div>
@endsection    