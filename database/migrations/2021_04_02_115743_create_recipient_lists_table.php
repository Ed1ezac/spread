<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('recipient_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('entries');
            $table->enum('status', ['processed', 'pending', 'invalid']);
            $table->unsignedBigInteger('user_id');
            $table->string('file_extension');
            $table->unsignedBigInteger('file_size');
            $table->string('file_path');
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
        Schema::dropIfExists('recipient_lists');
    }
}
