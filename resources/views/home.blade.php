@extends('layouts.landing-header')

@push('page-css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
@endpush

@section('content')
  <section class="">
    <div class="relative bg-white overflow-hidden">
      <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-4 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
          <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <polygon points="40,0 80,0 40,100 0,100"/>
          </svg>
          <!--intro text-->
          <div class="pt-20 pb-4 mx-auto bg-white max-w-7xl px-4 sm:px-6 lg:pt-20 lg:px-8 xl:pt-28">
            <div class="sm:text-center lg:text-left">
              <h1 class="leading-none text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Welcome to Spread</span>
                <span class="block text-accent-600 xl:inline">bulk sms service</span>
              </h1>
              <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                Send an sms to a large number of people with one click. Whether it's to increase your business presence, reach your clients easily or create awareness about an issue, Spread is your solution.
              </p>
              <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                @if(Auth::check())
                <div class="rounded-md shadow">
                  <a href="/create" class="w-full flex font-headings shadow-md tracking-wider font-bold items-center justify-center px-8 py-3 border border-transparent text-base rounded-md text-white bg-primary-500 hover:bg-primary-700 md:py-4 md:text-lg md:px-10">
                    GET STARTED
                  </a>
                </div>
                @else
                <div class="rounded-md shadow">
                  <a href="/login" class="w-full flex font-headings shadow-md tracking-wider font-bold items-center justify-center px-8 py-3 border border-transparent text-base rounded-md text-white bg-primary-500 hover:bg-primary-700 md:py-4 md:text-lg md:px-10">
                    GET STARTED
                  </a>
                </div>
                @endif
                <div class="mt-3 sm:mt-0 sm:ml-3">
                  <a href="/learn-more" class="w-full flex font-headings tracking-wider font-bold items-center justify-center px-8 py-3 border border-gray-300 text-base rounded-md text-gray-700 hover:text-white hover:bg-primary hover:border-primary md:py-4 md:text-lg md:px-10">
                    LEARN MORE
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="lg:absolute pt-12 bg-primary-100 lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="object-contain h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ asset('girl_reading_sms.svg') }}" alt="">
      </div>
    </div>
  </section>
  <section>
    <div class="px-8 sm:px-14 pt-14 pb-24 lg:mx-auto max-w-7xl">
      <div class="text-center mb-20">
        <h2 class="font-headings text-base text-accent-600 font-semibold tracking-wide uppercase">The Process</h2>
        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          Quick Easy Steps
        </p>
        <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
          The steps involved from getting started to sending are easy and straight forward.
        </p>
      </div>
        <div class="flex sm:flex-row flex-col items-center">
          <div class="flex-shrink-0 h-16 w-16 bg-accent-900 rounded-full">
            <div class="flex h-full justify-center items-center">
              <span class="table-cell text-sm text-white font-bold align-middle">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                  </svg>
              </span>
            </div>
          </div>
          <div class="mt-2 sm:mt-0 sm:ml-9 flex-col text-center sm:text-left">
            <h3 class="text-gray-700 text-xl lg:text-2xl font-semibold">Login to your Spread account</h3>
            <p class="text-gray-500 lg:text-lg">You have to login to your account in order to start sending sms. Register an account if you don't have one already.</p>
          </div>
        </div>

        <div class="relative hidden sm:block">
          <div class="absolute bg-accent-900 w-1 rounded ml-7 -mt-1 h-80 flex align-center items-center content-center" style="z-index:-1;">
          </div>
        </div>

        <div class="flex sm:flex-row flex-col mt-14 items-center">
          <div class="flex-shrink-0 h-16 w-16 bg-accent-900 rounded-full">
            <div class="flex h-full justify-center items-center">
                <span class="table-cell text-sm text-white font-bold align-middle">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                </span>
              </div>
            </div>
          <div class="mt-2 sm:mt-0 sm:ml-9 flex-col text-center sm:text-left">
            <h3 class="text-gray-700 text-xl lg:text-2xl font-semibold">Upload a Recipient List</h3>
            <p class="text-gray-500 lg:text-lg">Upload a csv, xls or xlsx file containing the numbers of the people you want to send the sms to.</p>
          </div>
        </div>

        <div class="flex sm:flex-row flex-col mt-14 items-center">
          <div class="flex-shrink-0 h-16 w-16 bg-accent-900 rounded-full">
            <div class="flex h-full justify-center items-center">
              <span class="table-cell text-sm text-white font-bold align-middle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
              </span>
            </div>
          </div>
          <div class="mt-2 sm:mt-0 sm:ml-9 flex-col text-center sm:text-left">
            <h3 class="text-gray-700 text-xl lg:text-2xl font-semibold">Add Funds</h3>
            <p class="text-gray-500 lg:text-lg">Buy the number of smses you would like to send via a secured Visa or Mastercard payment.</p>
          </div>
        </div>

        <div class="flex sm:flex-row flex-col mt-14 items-center">
          <div class="flex-shrink-0 h-16 w-16 bg-accent-900 rounded-full">
            <div class="flex h-full justify-center items-center">
              <span class="table-cell text-sm text-white font-bold align-middle">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
              </span>
            </div>
          </div>
          <div class="mt-2 sm:mt-0 sm:ml-9 flex-col text-center sm:text-left">
            <h3 class="text-gray-700 text-xl lg:text-2xl font-semibold">Create the sms</h3>
            <p class="text-gray-500 lg:text-lg">Now you can create the sms and choose to send it immediately or later.
              Note: You may need to register a sender name before sending smses.</p>
          </div>
        </div>
    </div>
  </section>
  <section class="bg-accent-600">
    <div class="px-8 py-24">
        <div class="flex flex-col h-full justify-center items-center">
          <div class="text-center">
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
              Boost your presence.
            </p>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
              Start using Spread today.
            </p>
            <p class="mt-2 text-base leading-8 text-white sm:text-xl">
              Start using Spread today and enjoy a hassle free outreach to your customers.
            </p>
            <div class="px-4 py-3 mt-4 text-center sm:px-6">
              @if(!Auth::check())
              <a href="/register" class="inline-flex justify-center py-2 px-4 mr-4 mb-4 sm:mb-0 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                REGISTER
              </a>
              @endif
              <a href="/learn-more" class="inline-flex justify-center py-2 px-4 my-btn border-white text-gray-700 bg-white hover:border-primary-500 hover:bg-primary-500 focus:ring-primary-800">
                  <svg class="-ml-1 mr-2 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  LEARN MORE
              </a>  
            </div>
          </div>
        </div>
    </div>
  </section>
  <section class="bg-primary-100">
    <div class="px-8 sm:px-14 py-24 lg:mx-auto max-w-7xl">
      <div class="flex flex-wrap justify-between">
        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-700 sm:text-4xl">
          This system is powered by
        </p>
        <div class="flex mt-2 md:mt-0">
          <div class="font-headings font-bold mr-2 border-2 border-primary-200 rounded-md text-primary-800 p-2">
            BUFFALO I.T
          </div>
          <!--div class="font-headings font-bold border-2 border-primary-200 rounded-md text-primary-800 p-2">
            COMPANY-2
          </!--div-->
        </div>
      </div>
    </div>
  </section>
  @include('components.footer')
@endsection
@push('page-js')
  <script>
      localStorage.removeItem('smsId');
      localStorage.removeItem('sendingDate');
      localStorage.removeItem('sendingTime');
  </script>
@endpush