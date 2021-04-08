@extends('layouts.dashboard-header')

@section('features')
    <h3 class="text-lg ml-4 font-bold leading-6 text-gray-900">New sms</h3>
      <sms-wizard 
          graphic-uri = "{{ asset('android-device.svg') }}"
          recipients = "{{ $recipients }}"
      ></sms-wizard>
      </div>
@endsection

@push('page-js')
<script>
  function storageAvailable(type) {
      var storage;
      try {
          storage = window[type];
          var x = '__storage_test__';
          storage.setItem(x, x);
          storage.removeItem(x);
          return true;
      }
      catch(e) {
        return e instanceof DOMException && (
            // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            (storage && storage.length !== 0);
      }
  }
  //and we're from summary page
  if(storageAvailable('sessionStorage')){
    //restore data on fields from persistance

    
  }

  function populateForm(){
    var senderName = localStorage.getItem('sender_name');
    var message = localStorage.getItem('message');

    document.getElementById('sender_name').value = senderName;
    document.getElementById('message').value = message;
  }

  //listener for on submit-clicked
  function persistToStorage() {
    sessionStorage.setItem('sendername', document.getElementById('sender_name').value);
    sessionStorage.setItem('message', document.getElementById('message').value);
    //sessionStorage.setItem('recipientsid', document.getElementById('recipientsid').value);
    //sessionStorage.setItem('recipientsname', document.getElementById('recipientsname').value);
  } 
</script>
@endpush