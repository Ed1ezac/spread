@extends('layouts.landing-header')

@section('content')
<!--sidebar-->
<sidebar current-url="{{ Request::segment(1) }}"></sidebar>
<!--main stuff-->
<main class="pl-8 sm:pl-56 xl:pl-60 pr-6 pt-20">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if (strcmp($error, "This user account is suspended")===0)
                <error-banner v-bind:disappears="false" error="{{$error}}"></error-banner>
            @else
                <error-banner v-bind:disappears="true" error="{{$error}}"></error-banner>    
            @endif
            
        @endforeach
    @endif

    @if(session('status'))
        <notification-banner message="{{ session('status') }}"></notification-banner>
    @endif
    @yield('features')
</main>
@endsection