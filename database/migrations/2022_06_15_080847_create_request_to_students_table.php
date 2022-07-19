<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_to_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id')->nullable();
            $table->string('request_from')->nullable();
            $table->string('document_name')->nullable();
            $table->string('date_of_request')->nullable();
            $table->string('status')->default('pending');
            $table->string('response_status')->default('requested');
            $table->string('message')->nullable();
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('request_to_students');
    }
}
