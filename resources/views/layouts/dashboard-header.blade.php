@extends('layouts.landing-header')

@section('content')
<!--sidebar-->
<sidebar current-url="{{ Request::segment(1) }}"></sidebar>
<!--main stuff-->
<main class="sm:pl-60 pl-6 pr-6 pt-20">
    @yield('features')
</main>
@endsection