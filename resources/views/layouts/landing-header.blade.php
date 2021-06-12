<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Spread') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Favicons-->
        <link rel="shortcut icon" type="image/png" href="{{ asset('icon/icon-32.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon/favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('icon/apple-icon-60.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('icon/apple-icon-76.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('icon/apple-icon-120.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('icon/apple-icon-152.png') }}">

        @stack('page-css')
    </head>

    <body class="font-body bg-gray-50">
        <div id="app">
        <my-navbar 
            v-bind:is-admin="{{ json_encode(
                Auth::check() ?
                    Auth::user()->hasRole('administrator')
                    : false
                ) }}"
            v-bind:username="{{ 
                json_encode(
                    Auth::check() ? 
                        Auth::user()->name
                        : ''
                ) }}"
            logo-uri="{{asset('logo.svg')}}" 
            logo-uri-sm="{{asset('logo-small.svg')}}"
            register-route="{{ route('register') }}"
            login-route="{{ route('login') }}"
            v-bind:is-auth="{{ json_encode(Auth::check()) }}"></my-navbar>
            <!--- Main Page Content ---> 
            @yield('content')
            
        </div>
        <!---->
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('page-js')
    </body>
</html>    