<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_id')->nullable;
            $table->string('student_id')->nullable();
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->string('request_date')->nullable();
            $table->string('release_date')->nullable();
            $table->string('processing_officer')->nullable();
            $table->string('status')->default('sent');
            $table->string('date_sent')->nullable();
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
        Schema::dropIfExists('response_table');
    }
}
