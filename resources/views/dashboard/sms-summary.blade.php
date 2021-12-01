@extends('layouts.dashboard-header')

@section('features')
    <!---
        the capacity and funds
    --->
    <div class="flex flex-wrap pr-4">
        <sms-summary v-bind:recipients = "{{ json_encode($recipients) }}"></sms-summary>
        <div class="sm:ml-6 ml-2 w-72">
            <div class="ml-2 border border-gray-300 rounded p-2">
                <h3 class="text-gray-400 font-medium text-base">Billing</h3>
                <div class="mt-2 divide-y divide-gray-200">
                    <div class="flex flex-col">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-400">Funds</p>
                            <p class="text-lg text-gray-600 font-semibold">{{ $funds->amount }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-400">Cost</p>
                        <p class="text-lg text-gray-600 font-semibold">- {{ $recipientsCount }}</p>
                        </div>
                    </div>
                    <div class="mt-1 flex justify-between items-center">
                        <p class="text-base text-gray-400">Balance</p>
                        @if($funds->amount < $recipientsCount)
                        <p class="text-lg text-red-400 font-semibold">{{ $funds->amount - $recipientsCount }}</p>
                        @else
                        <p class="text-lg text-gray-600 font-semibold">{{ $funds->amount - $recipientsCount }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection