@extends('layouts.dashboard-header')

@section('features')
    <h3 class="text-lg ml-4 font-bold leading-6 text-gray-900">New sms</h3>
      <div class="mt-2 mb-4 md:grid md:grid-cols-3 2xl:grid-cols-2 md:gap-4 xl:gap-0 px-4">
        <!--form-->
        <div class="shadow-sm col-span-2 2xl:col-span-1 pt-2 bg-white rounded-sm 2xl:max-w-full max-w-3xl md:mr-6">
            <form action="#" method="POST">
              <div class="px-6 py-2 space-y-6 sm:p-6">
                  <!--sender-->
                  <div>
                    <label for="sender_name" class="my-form-label">
                      Sender
                    </label>
                    <input type="text" name="sender_name" id="sender_name" autocomplete="sender-name" class="w-full my-form-input">
                  </div>
                  <!--message-->
                  <div>
                    <label for="message" class="my-form-label">
                      Message
                    </label>
                    <div class="mt-1">
                      <textarea id="message" id="message" name="message" rows="3" class="w-full my-form-input" placeholder="Type your text message here"></textarea>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">
                      140 symbols per message (including spaces).
                    </p>
                  </div>
                  <!--recipients-->
                  <div class="mb-2 focus:outline-none">
                    <label for="recipients" class="my-form-label">
                      Recipients
                    </label>
                    <select id="recipients" name="recipients" autocomplete="recipients" class="w-full py-2 px-3 font-body my-form-input border font-semibold">
                      <option class="font-semibold font-body text-gray-800">Stokvel</option>
                      <option class="font-semibold font-body text-gray-800">Work Mates</option>
                      <option class="font-semibold font-body text-gray-800">Invitees</option>
                    </select>
                    <p class="mt-2 text-xs text-gray-500">
                      Dont have a recipient list yet? <a href="/recipients" class="text-accent-800 underline font-semibold hover:text-accent-500">create one</a>
                    </p>
                  </div>
              </div>
            </form>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                PROCEED
              </button>   
            </div>
        </div>
        <!--preview-->
        <div class="px-2 hidden md:block">
        <img class="max-h-96" src="{{ asset('android-device.svg') }}" alt="preview">
        </div>
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