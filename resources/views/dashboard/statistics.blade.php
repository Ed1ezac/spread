@extends('layouts.dashboard-header')


@section('features')
    @if(session('status'))
      <notification-banner message="{{ session('status') }}"></notification-banner>
    @endif

@endsection