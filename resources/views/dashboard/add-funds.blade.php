@extends('layouts.dashboard-header')

@section('features')
<!-- credit card details -->
<h3 class="text-lg ml-4 font-headings font-bold text-gray-900">ADD FUNDS</h3>
<div class="ml-4 mt-4 flex md:flex-row flex-col ">
    <div class="w-96 px-2">
        <form action="#" method="POST">
            <!--Details-->
            <div>
                <!--Full Name--->
                <div>
                    <input type="text" name="names" id="names" autocomplete="names" placeholder="Full Name" class="w-full my-form-input">
                </div>
                <!---SMS-->
                <div class="mt-3">
                    <input type="text" name="quantity" id="quantity" autocomplete="quantity" placeholder="SMS Quantinty" class="w-full my-form-input">
                </div>
                <!---Card Details-->
                <div class="mt-3">
                    <div class="mt-1 relative rounded">
                        <input type="text" name="card" id="price" class="w-full pr-12 my-form-input" placeholder="Card Number">
                        <div class="absolute inset-y-0 flex right-0">
                            <input type="text" name="date" class="h-full px-1 w-16 my-form-input mt-0 border-transparent bg-transparent" placeholder="MM/YY">
                            <input type="text" name="cvc" class="h-full w-14 pr-1 my-form-input mt-0 border-transparent bg-transparent" placeholder="CVC">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 mb-3 mt-4 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </span>
            PURCHASE
            </button>
        </form>
    </div>
    <!--Invoice-->
    <div class="md:ml-14 ml-2">
        <div class="shadow-sm border border-gray-300 overflow-hidden w-64 rounded-md">
            <div class="p-2 bg-white">
                <div class="flex-col ml-2">
                    <h5 class="text-base text-gray-400 font-bold">PURCHASING</h5>
                    <div class="divide-y divide-y-8 divide-gray-300">
                        <div class="flex-col">
                            <p class="text-gray-600 text-right font-headings text-3xl font-bold">8'000<span class="text-gray-800 text-sm font-extrabold">sms</span></p>
                            <p class="text-gray-400 text-right font-headings text-base font-bold">@ P 0.15 <span class="text-gray-800 text-sm font-extrabold">/ sms</span></p>
                        </div>
                        <p class="text-gray-800 my-1 pt-2 text-right font-headings text-3xl font-bold">P 762.67</p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection