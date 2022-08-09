<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesOnStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_info', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('batch')->nullable();
            $table->string('school_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_info', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('batch');
            $table->dropColumn('school_year');
        });
    }
}
