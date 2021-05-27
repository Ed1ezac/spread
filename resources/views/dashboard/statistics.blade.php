@extends('layouts.dashboard-header')


@section('features')
  @if ($errors->any())
    @foreach ($errors->all() as $error)
    <error-banner error="{{$error}}"></error-banner>
    @endforeach
  @endif
  <sms-rollout-progress
    user-id="{{Auth::id()}}"
  ></sms-rollout-progress>
@endsection
@push('page-js')
    <script>
        localStorage.removeItem('smsId');
        localStorage.removeItem('sendingDate');
        localStorage.removeItem('sendingTime');
    </script>
@endpush