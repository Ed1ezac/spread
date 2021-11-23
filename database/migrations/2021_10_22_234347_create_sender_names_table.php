<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenderNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sender_names', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('sender_name');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->mediumText('reason');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('company_tax_number');
            $table->string('company_contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sender_names');
    }
}
