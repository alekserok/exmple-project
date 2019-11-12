<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerformersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('letter')->nullable();
                $table->string('name')->nullable();
                $table->string('country')->nullable();
                $table->text('eyes')->nullable();
                $table->text('hair')->nullable();
                $table->text('body_details')->nullable();
                $table->text('availability')->nullable();
                $table->decimal('price', 10, 2);
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
        Schema::drop('performers');
    }
}
