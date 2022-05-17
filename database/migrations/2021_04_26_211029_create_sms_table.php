<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->string('sender', 20);
            $table->text('message');
            $table->string('order_no')->nullable();
            $table->enum('status', ['draft', 'pending', 'sent', 'aborted','failed']);
            $table->foreignId('recipient_list_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('job_id')->nullable();
            $table->timestamp('send_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
