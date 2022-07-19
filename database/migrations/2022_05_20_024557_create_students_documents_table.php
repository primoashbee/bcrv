<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name')->nullable();
            $table->string('description')->nullable();
            $table->string('path')->nullable();
            $table->string('size')->nullable();
            $table->string('datetime')->nullable();
            $table->string('submitted_by')->nullable();
            
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
        Schema::dropIfExists('students_documents');
    }
}
