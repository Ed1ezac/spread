@extends('layouts.landing-header')

@section('content')
<!--Admin sidebar-->
<admin-sidebar current-url="{{ Request::segment(1) }}"></admin-sidebar>
<!--main stuff-->
<main class="sm:pl-56 pl-6 pr-6 pt-20">
    @if(session('status'))
        <notification-banner message="{{ session('status') }}"></notification-banner>
    @endif
    @yield('features')
</main>
@endsection