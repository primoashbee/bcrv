<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_info', function (Blueprint $table) {
            $table->string("firstname");
            $table->string("lastname");
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
            $table->dropColumn("firstname");
            $table->dropColumn("lastname");

        });
    }
}
