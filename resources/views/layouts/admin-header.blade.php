@extends('layouts.landing-header')

@section('content')
<!--Admin sidebar-->
<admin-sidebar current-url="{{ Request::segment(2) }}"></admin-sidebar>
<!--main stuff-->
<main class="pl-8 pr-6 sm:pl-56 xl:pl-60 pt-20">
    @if(session('status'))
        <notification-banner message="{{ session('status') }}"></notification-banner>
    @endif
    @yield('features')
</main>
@endsection