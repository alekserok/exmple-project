<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->string('visa_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('language')->nullable();
            $table->string('contacts')->nullable();
            $table->string('socials')->nullable();
            $table->string('attachment')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('careers');
    }
}
