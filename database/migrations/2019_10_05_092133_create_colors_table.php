<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->string('color', 25);
        });

        Schema::create('color_performer', function (Blueprint $table) {
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('performer_id');

            $table->foreign('performer_id')
                ->references('id')
                ->on('performers')
                ->onDelete('cascade');

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');

            $table->unique(['performer_id', 'color_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('color_performer');
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_color_id_foreign');
        });
        Schema::drop('colors');
    }
}
