@extends('layouts.dashboard-header')

@section('features')
<!-- credit card details -->
<h3 class="text-lg ml-4 font-headings font-bold text-gray-900">ADD FUNDS</h3>

<funds-purchase
    v-bind:validation-errors="{{ json_encode($errors->all()) }}">
</funds-purchase>
@endsection