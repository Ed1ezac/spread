@extends('layouts.dashboard-header')


@section('features')
<div class="ml-12">
    <p>{{ Request::segment(1) }}</p>
</div>

@endsection