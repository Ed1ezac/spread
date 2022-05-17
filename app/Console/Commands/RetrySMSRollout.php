<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RetrySMSRollout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:retry {uuid?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry a failed sms rollout job';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('uuid')) { 
            $job = DB::table('failed_jobs')
                    ->where([['queue', '=','rollouts'],
                    ['uuid', '=', $this->argument('uuid')]
                ])->first();

            if($job !== null){
                Artisan::call('job:retry '.$job->uuid);
            }
       }
    }
}
