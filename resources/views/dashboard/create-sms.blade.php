@extends('layouts.dashboard-header')

@section('features')
      <sms-wizard 
          graphic-uri = "{{ asset('android-device.svg') }}"
          v-bind:recipients = "{{ json_encode($recipients) }}">
      </sms-wizard>
      </div>
@endsection