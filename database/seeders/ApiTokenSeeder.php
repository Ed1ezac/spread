<?php

namespace Database\Seeders;

use App\Models\SmsApiToken;
use Illuminate\Database\Seeder;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SmsApiToken::create(['value' => 'sGdfd349loO9blZso0462']);
    }
}
