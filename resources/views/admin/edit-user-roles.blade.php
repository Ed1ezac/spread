@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif
    <div>
        <div class="shadow-sm flex-shrink bg-white rounded-md w-96 md:mr-2">
            <form action="/admin/user/add/role" method="POST">
                @csrf
                <div class="px-6 pb-6 space-y-6 divide divide-y-2 divide-gray-100">
                    <div class="mt-4">
                        <div class="pt-4 flex items-center">
                            <div class="w-12 h-12 relative mb-4">
                                <div class="w-full h-full bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                                    <span class="table-cell text-white font-bold align-middle">{{ $user->initials }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-base font-medium text-gray-900">
                                {{$user->name}}
                                </div>
                                <div class="text-sm text-gray-500">
                                {{$user->email}}
                                </div>
                                <div class="text-xs mt-1 font-bold text-gray-500">
                                ROLES: &nbsp
                                    <span class="text-gray-800">
                                    @foreach($user->roles as $role)
                                        {{ $role->name.', '}}
                                    @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <roles-drop-down v-bind:roles="{{ json_encode($roles) }}"></roles-drop-down>
                    </div>
                    <input type="hidden" name="userId" value="{{$user->id}}"/>
                </div>
                <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                    <button type="submit" formaction="/admin/user/remove/role" class="inline-flex justify-center py-2 px-4 mr-2 my-btn border-gray-300 text-gray-700 bg-gray-50 hover:border-primary-500 hover:bg-primary-500 focus:ring-primary-800">
                        <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        REMOVE
                    </button>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        ADD
                    </button>   
                </div>
            </form>    
        </div>
    </div>
@endsection