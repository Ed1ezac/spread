@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif
    <div class="flex flex-wrap justify-between items-start">
        <div class="w-80">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
            <div class="flex justify-between">
                <h3 class="my-2 text-sm text-gray-800 font-medium">Current API Token</h3>
                <div>
                  @if ((isset($token) && !empty($token)) && $token->updated_at < now()->subMinutes('45'))
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                        expired
                    </span>
                  @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        valid
                    </span>  
                  @endif  
                </div>
            </div>
            @if (isset($token) && !empty($token))
            <p class="my-2 text-sm text-gray-400 font-medium">
                {{ $token->value }}   
            </p>
            <div class="flex justify-between items-center">
                <div class="text-xs text-gray-700 font-medium">
                {{ 'Last updated: '.$token->updated_at->diffForHumans() }}
                </div>
                <form action="{{ route('token.refresh.manual') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs font-semibold font-headings text-gray-700 hover:text-accent-800">
                    Refresh Token
                    </button>
                </form>
            </div>
            @else
            <p class="my-2 text-sm text-gray-400 font-medium">
                --No token issued yet--
            </p>
            @endif 
            </div>
        </div>
        <a href="/admin/orange-info/test-sms" class="inline-flex mt-2 sm:mt-0 items-center uppercase tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
            <svg class="transform rotate-45 -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
            Send Test Sms
        </a>
    </div>

    <div class="flex flex-wrap mt-8">
        <div class="shadow-md w-96 mb-4 mr-8 border bg-white border-gray-50 rounded">
            <div class="flex justify-between items-center mx-2">
                <h3 class="my-2 text-sm text-gray-800 font-medium">Contract Balance</h3>
            </div>
            <div class="divide-y divide-dashed divide-gray-300">
                <div class="mx-2 pt-2 flex justify-between">
                    <div class="text-xs text-gray-500">Country:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                        @if(!empty($contract) && array_key_exists('country', $contract))
                        {{$contract[0]['country']}}
                        @else
                        N/A
                        @endif
                    </div>
                </div>
                <div class="mx-2 pt-2 flex justify-between">
                    <div class="text-xs text-gray-500">Service:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                        @if(!empty($contract) && array_key_exists('service', $contract))
                        {{$contract[0]['service']}}
                        @else
                        N/A
                        @endif
                    </div>
                </div>
                <div class="mx-2 pt-2 flex justify-between">
                    <div class="text-xs text-gray-500">ContractId:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                    @if(!empty($contract) && array_key_exists('contractId', $contract))
                    {{$contract[0]['contractId']}}
                    @else
                    N/A
                    @endif
                    </div>
                </div>
                <div class="mx-2 pt-2 flex justify-between">
                    <div class="text-xs text-gray-500">Available Units:</div>
                    <div class="ml-12 text-xs text-gray-800 font-bold">
                        @if(!empty($contract) && array_key_exists('availableUnits', $contract))
                        {{$contract[0]['service']}}
                        @else
                        N/A
                        @endif
                    </div>
                </div>
                <div class="mx-2 py-1 flex justify-between">
                    <div class="text-xs text-gray-500">Units Expiry:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                        @if(!empty($contract) && array_key_exists('expires', $contract))
                        {{$contract[0]['expires']}}
                        @else
                        N/A
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden rounded w-80 mb-4 border border-gray-200">
            <div class="flex justify-between items-center mx-2">
                <h3 class="mt-2 text-sm text-gray-800 font-medium">Usage Details</h3>
            </div>
            <div class="divide-y divide-dashed divide-gray-300">
                <div class="mx-2 pt-2 flex justify-between">
                    <div class="text-xs text-gray-500">Usage:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                        @if(!empty($statistic) && array_key_exists('usage', $statistic['countryStatistics'][0]))
                        {{$statistic['countryStatistics'][0]['usage']}}
                        @else
                        N/A
                        @endif
                    </div>
                </div>
                <div class="mx-2 pt-2 flex justify-between">
                    <div class="text-xs text-gray-500">App ID:</div>
                    <div class="ml-12 text-xs text-gray-700 font-medium">
                        @if(!empty($statistic) && array_key_exists('applicationId', $statistic['countryStatistics'][0]))
                        {{$statistic['countryStatistics'][0]applicationId}}
                        @else
                        N/A
                        @endif
                    </div>
                </div>
            </div>
        </div>    
    </div>

@endsection    