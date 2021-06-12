@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if($error[0] !='amount')
            <error-banner error="{{$error}}"></error-banner>
            @endif
        @endforeach
    @endif
    <div>Start Queue Workers here.</div>
@endsection    