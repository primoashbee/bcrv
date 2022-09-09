<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('learner_id')->unique()->nullable();
            $table->date('entry_date')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('ext_name')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('birthday')->nullable();
            $table->string('birth_city')->nullable();
            $table->string('birth_province')->nullable();
            $table->string('birth_region')->nullable();
            $table->string('educational_attainment')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_mailing_address')->nullable();
            $table->string('classification')->nullable();
            $table->string('others_classification')->nullable();
            $table->string('disability_type')->nullable();
            $table->string('disability_cause')->nullable();
            $table->string('course_qualification')->nullable();
            $table->string('scholarship_package')->nullable();
            $table->date('date_received')->nullable();
            $table->boolean('finished')->default(false);
            $table->dateTime('finished_at')->nullable();

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
        Schema::dropIfExists('learners');
    }
}
