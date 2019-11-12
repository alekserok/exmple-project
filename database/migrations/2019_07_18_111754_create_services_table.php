<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
        });

        Schema::create('performer_service', function (Blueprint $table) {
            $table->unsignedInteger('performer_id');
            $table->unsignedInteger('service_id');

            $table->foreign('performer_id')
                ->references('id')
                ->on('performers')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');

            $table->unique(['performer_id', 'service_id']);
        });

        \Illuminate\Support\Facades\DB::unprepared("
            INSERT INTO `services` (`name`) VALUES
            ('{\"en\":\"Anal\",\"ja\":\"Anal\"}'),
            ('{\"en\":\"Bondage\",\"ja\":\"Bondage\"}'),
            ('{\"en\":\"Boyfriend experience\",\"ja\":\"Boyfriend experience\"}'),
            ('{\"en\":\"Cum on body\",\"ja\":\"Cum on body\"}'),
            ('{\"en\":\"Cosplay\",\"ja\":\"Cosplay\"}'),
            ('{\"en\":\"Cuddling\",\"ja\":\"Cuddling\"}'),
            ('{\"en\":\"Cum in mouth\",\"ja\":\"Cum in mouth\"}'),
            ('{\"en\":\"Domination\",\"ja\":\"Domination\"}'),
            ('{\"en\":\"Deep French kissing\",\"ja\":\"Deep French kissing\"}'),
            ('{\"en\":\"Girlfriend experience\",\"ja\":\"Girlfriend experience\"}'),
            ('{\"en\":\"Handjob\",\"ja\":\"Handjob\"}'),
            ('{\"en\":\"Lapdance\",\"ja\":\"Lapdance\"}'),
            ('{\"en\":\"Oral\",\"ja\":\"Oral\"}'),
            ('{\"en\":\"Overnight\",\"ja\":\"Overnight\"}'),
            ('{\"en\":\"Sadism\",\"ja\":\"Sadism\"}'),
            ('{\"en\":\"Masochism\",\"ja\":\"Masochism\"}'),
            ('{\"en\":\"Massage\",\"ja\":\"Massage\"}'),
            ('{\"en\":\"Nuru\",\"ja\":\"Nuru\"}');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
        Schema::drop('performer_service');
    }
}
