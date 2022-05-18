@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif

    
    <div>
        <div class="bg-white shadow p-4">
            <div class="flex justify-between">
                <h5 class="font-medium">{{$email->from}}</h5>

            </div>
            <div class="mt-4 mb-3">
                <p>{{ $email->message }}</p>
            </div>
        </div>
    </div>


@endsection