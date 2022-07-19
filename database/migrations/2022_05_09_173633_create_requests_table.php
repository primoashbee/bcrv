<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id')->nullable();
            $table->string('course')->nullable();
            $table->string('document_name')->nullable();
            $table->integer('number_of_copies')->nullable();
            $table->string('date_of_request')->nullable();
            $table->string('release_date')->nullable();
            $table->string('processing_officer')->nullable();
            $table->string('status')->default('pending');
            $table->string('is_responded')->default(0);
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
        Schema::dropIfExists('requests');
    }
}
