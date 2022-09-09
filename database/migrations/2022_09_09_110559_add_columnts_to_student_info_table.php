<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumntsToStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_info', function (Blueprint $table) {
            $table->string('middlename')->nullable();
            $table->string('ext_name')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_finished')->default(false);
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
            $table->dropColumn('middlename');
            $table->dropColumn('ext_name');
            $table->dropColumn('address');
            $table->dropColumn('is_finished');
        });
    }
}
