@extends('layouts.dashboard-header')

@section('features')
    <!---
        the message/preview
        the recipient list
        the capacity and funds
        the sending action - 'now/later'
    --->
    <div class="flex space-x-4">
        <sms-summary v-bind:recipients = "{{ json_encode($recipients) }}"></sms-summary>
        <div class="w-64">
            <div class="bg-primary-100 rounded-sm p-2">
                <h3 class="text-gray-600 text-base">Billing</h3>
                <div class="mt-1 divide-y divide-gray-50">
                    <div class="flex flex-col">
                        <div class="flex justify-between items-center">
                            <p class="text-base text-gray-600">Funds</p>
                            <p class="text-lg text-gray-600 font-semibold">P 70'000</p>
                        </div>
                        <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-600"><span class="text-gray-800 font-bold">0.15 </span>t / sms</p>
                        <p class="text-lg text-gray-600 font-semibold">-P 60'000</p>
                        </div>
                    </div>
                    <div class="mt-1 flex justify-between items-center">
                        <p class="text-base text-gray-600">Bal</p>
                        <p class="text-lg text-gray-600 font-semibold">P 10'000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection