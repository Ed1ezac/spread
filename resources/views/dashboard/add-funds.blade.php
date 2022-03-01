@extends('layouts.dashboard-header')

@section('features')
<!-- credit card details -->
<h3 class="text-md font-medium text-gray-900">Add Funds</h3>

@if(true)
<div class="mt-12 text-gray-500">
    The system does not support online purchases yet. To buy SMS credit please contact:
    <div class="flex-col my-6">
        <p class="mb-2">Mr. E. Kealeboga</p>
        <div class="flex flex-col sm:flex-row">
            <p class="text-3xl font-light">76067957<span class="text-xs">Mascom</span> / </p>
            <p class="text-3xl font-light">75275918 <span class="text-xs">Orange</span></p>
        </div>
    </div>
</div>
<p class="text-gray-600">NOTE: The minimum order quantity is <span class="text-2xl font-medium text-gray-800">50</span> SMSs'</p>
@else
<funds-purchase
    v-bind:validation-errors="{{ json_encode($errors->all()) }}">
</funds-purchase>
@endif

@endsection