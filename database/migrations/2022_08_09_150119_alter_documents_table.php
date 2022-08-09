<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('documents');
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename')->unique();
            $table->longText('description')->nullable();
            $table->boolean('signed')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('documents');

        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name')->nullable();
            $table->string('description')->nullable();
            $table->string('path')->nullable();
            $table->string('size')->nullable();
            $table->string('datetime')->nullable();
            $table->timestamps();
        });
    }
}
