<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('complete_name')->nullable();
            $table->string('course')->nullable();
            $table->string('year')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE students AUTO_INCREMENT = 100000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
