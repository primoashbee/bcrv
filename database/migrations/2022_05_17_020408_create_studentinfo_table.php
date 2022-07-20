<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('alternate_id')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('course')->nullable();
            $table->string('year')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('education_level');
            $table->string('status')->default('1');
            $table->timestamps();
        });

        DB::table('student_info')->insert(['alternate_id' => 1000000, 'name' => 'default_Student','education_level'=>'College']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_info');
    }
}
