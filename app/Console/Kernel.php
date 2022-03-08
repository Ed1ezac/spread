<?php

namespace App\Console;

use App\Helpers\TokenPuller;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){
        //->everyFifteenMinutes()
        $schedule->call(new TokenPuller)
                ->cron('*/20 * * * *')//every other 20 minutes
                ->between("06:15", "22:02");
        
        $schedule->command('mailbox:clean')->daily();
    }

    /**
     * Register the commands for the application.
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
