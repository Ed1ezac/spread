@extends('layouts.dashboard-header')

@section('features')
        <!-----Todo ---->
      <sms-wizard
          sender-error =""
          message-error=""
          graphic-uri = "{{ asset('android-device.svg') }}"
          v-bind:recipients = "{{ json_encode($recipients) }}">
      </sms-wizard>
@endsection