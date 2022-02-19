<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use BeyondCode\Mailbox\InboundEmail;
use BeyondCode\Mailbox\Facades\Mailbox;
use App\Mail\Inbound\HandleSupportEmail;
use App\Mail\Inbound\HandleEnquiriesEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //inbound-email
        Mailbox::to('support@spread.co.bw', HandleSupportEmail::class);
        Mailbox::to('enquiries@spread.co.bw', HandleEnquiriesEmail::class);
    }
}
