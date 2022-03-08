@extends('layouts.dashboard-header')


@section('features')
<!-- request Refund -->
@if (isset($funds) && $funds->amount > 0)
    <div class="flex flex-wrap justify-between items-start">
        <div class="w-80">
            <div class="bg-white shadow-sm rounded p-4 divide-y divide-gray-100">
                <div class="flex">
                    <div class="bg-accent-700 self-center border border-accent-700 p-2 rounded">
                        <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-col ml-4">
                        <h3 class="text-xs text-gray-500 font-medium">Balance</h3>
                        <p class="text-gray-800 text-2xl font-bold">{{ $funds->amount}}<span class="text-gray-500 text-xs font-bold"> sms</span></p>
                    </div>
                </div>
            </div>
        </div>
        @role('client')
        <a href="/funds/add" class="inline-flex mt-2 sm:mt-0 items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            ADD FUNDS
        </a>
        @endrole
    </div>

    @if(isset($history) && count($history)>0)
    <div class="mr-4 xl:mr-6 mt-8 xl:mt-10 mb-8">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="max-w-7xl shadow overflow-hidden border-b border-gray-200 sm:rounded">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                            Activity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                            Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                            Time
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($history as $record)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($record->event == 'deduction')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                    {{$record->event}}
                               </span>
                               @elseif($record->event == 'purchase')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{$record->event}}
                               </span>
                               @endif
                            </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-800">{{$record->amount}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($record->created_at->diffInDays() < 1 )
                                <div class="text-sm text-gray-500">
                                    {{$record->created_at->diffForHumans()}}
                                </div>
                                @else
                                <div class="text-sm text-gray-500">
                                    {{$record->created_at->toDayDateTimeString()}}
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="px-4 py-2">{{ $history->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif
@else
    <div class="ml-12 flex">
        <div class="mt-24 mb-12">
            <h3 class="text-3xl text-gray-700">Add Some Funds</h3>
            <p class="text-gray-500 mt-1">You need funds in your account.</p>
            <div class="flex-col space-y-2 px-2 py-3">
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-700 ml-2">Funds allow you to send bulk sms.</p>
                </div>
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-700 ml-2">Add funds depending on the number of people you want to send sms to.</p>
                </div>
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-700 ml-2">Once added, your funds will never expire.</p>
                </div>
            </div>
            <span class="sm:block mt-3">
                <a href="/funds/add" class="inline-flex items-center tracking-widest px-4 py-2 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ADD FUNDS
                </a>
            </span>
            
        </div>
        <div class="hidden sm:block ml-12 mt-8">
            <svg class="transform -rotate-45 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
    
@endif

<!--Empty view-->
<!--div class="">
    <div class="ml-12 flex">
        <div class="mt-32 mb-12">
            <h3 class="text-3xl text-gray-700">Add Some Funds</h3>
            <p class="text-gray-500 mt-1">You need funds in your account before you start sending bulk sms.</p>
            
            <span class="sm:block mt-3">
                <button type="button" class="inline-flex items-center px-4 tracking-wider py-2 border border-gray-300 rounded-sm shadow-md text-sm font-bold text-white bg-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ADD FUNDS
                </button>
            </span>
            
        </div>
        <div class="ml-12 mt-8">
            <svg class="transform -rotate-45 z-0 flex-shrink h-72 w-72 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
</!--div -->

<!--div> REFUNDS
    <div class="shadow-sm bg-white rounded-sm max-w-sm sm:block">
        <div class="flex bg-red-400 p-2 items-center">
            <svg class="flex-shrink-0 h-6 w-6 text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg ml-2 font-medium text-white">Refunds</h3>    
        </div>
        <div class="flex-col space-y-2 px-2 py-3">
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Our system does not support refunds at the moment</p>
            </div>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">To request a refund, you can <a href="#" class=""> contact us</a></p>
            </div>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-700 ml-2">Refunds may take time to process.</p>
            </div>
        </div>
    </div>
</!--div -->

@endsection
@push('page-js')
    <script>
        localStorage.removeItem('smsId');
        localStorage.removeItem('sendingDate');
        localStorage.removeItem('sendingTime');
    </script>
@endpush