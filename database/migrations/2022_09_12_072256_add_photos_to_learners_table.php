<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotosToLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learners', function (Blueprint $table) {
            $table->string('photo_path')->nullable();
            $table->string('signature_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learners', function (Blueprint $table) {
            $table->dropColumn('photo_path');
            $table->dropColumn('signature_path');
        });
    }
}
