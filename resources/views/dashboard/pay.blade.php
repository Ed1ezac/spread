@extends('layouts.dashboard-header')

@section('features')
<h3 class="text-lg ml-4 font-bold leading-6 text-gray-900">Add Funds</h3>
<div class="ml-4 mt-4">    
    <form action="#" method="POST">
        <div class="grid grid-cols-2 max-w-4xl space-y-6 space-x-8">
            <!--Details-->
            <div>
                <!--Full Name--->
                <div>
                    <input type="text" name="names" id="names" autocomplete="names" placeholder="Full Name" class="mt-2 block w-full text-sm rounded border-gray-200">
                </div>
                <!---SMS-->
                <div>
                    <input type="text" name="quantity" id="quantity" autocomplete="quantity" placeholder="SMS Quantinty" class="mt-2 block w-full text-sm rounded border-gray-200">
                </div>
                <!---Card Details-->
                <div>
                    <div class="mt-1 relative rounded">
                        <input type="text" name="card" id="price" class="focus:border-accent-800 block w-full pr-12 sm:text-sm border-gray-200 rounded" placeholder="Card Number">
                        <div class="absolute inset-y-0 flex right-0">
                            <input type="text" name="date" class="h-full px-1 w-16 sm:text-sm border-transparent bg-transparent rounded" placeholder="MM/YY">
                            <input type="text" name="cvc" class="h-full w-14 pr-1 sm:text-sm border-transparent bg-transparent rounded" placeholder="CVC">
                        </div>
                    </div>
                </div>
            </div>
            <!--Amount-->
            <div>
                <div class="shadow-sm border border-gray-300 overflow-hidden max-w-xs rounded-md">
                    <div class="p-2 bg-white">
                        <div class="flex-col ml-2">
                            <h5 class="text-base text-gray-400 font-bold">PURCHASING</h5>
                            <div class="flex mt-4 justify-between items-end">
                                <p class="text-gray-800 text-3xl font-bold">70'000 <span class="text-gray-800 text-sm font-extrabold">P</span></p>
                                <p class="text-gray-800 text-base font-bold">0.15t / SMS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </span>
            PURCHASE
            </button>
        </div>
    </form>
</div>
@endsection