<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
        });

        Schema::create('category_parent', function (Blueprint $table) {
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('category_id');

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });

        Schema::create('category_performer', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('performer_id');

            $table->foreign('performer_id')
                ->references('id')
                ->on('performers')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->unique(['performer_id', 'category_id']);
        });

        \Illuminate\Support\Facades\DB::unprepared("
            INSERT INTO `categories` (`name`) VALUES
            ('{\"en\":\"men\",\"ja\":\"men\"}'),
            ('{\"en\":\"women\",\"ja\":\"women\"}'),
            ('{\"en\":\"sexbot\",\"ja\":\"sexbot\"}'),
            ('{\"en\":\"featured\",\"ja\":\"featured\"}'),
            ('{\"en\":\"american\",\"ja\":\"american\"}'),
            ('{\"en\":\"trans\",\"ja\":\"trans\"}'),
            ('{\"en\":\"japanese\",\"ja\":\"japanese\"}'),
            ('{\"en\":\"european\",\"ja\":\"european\"}'),
            ('{\"en\":\"a/v star\",\"ja\":\"a/v star\"}'),
            ('{\"en\":\"bdsm\",\"ja\":\"bdsm\"}'),
            ('{\"en\":\"ebony\",\"ja\":\"ebony\"}');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
        Schema::drop('category_performer');
    }
}
