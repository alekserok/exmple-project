<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaqCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
        });

        \Illuminate\Support\Facades\DB::unprepared("
        INSERT INTO `faq_categories` (`name`) VALUES
           ('{\"en\":\"Payment\",\"ja\":\"Payment\"}'),
           ('{\"en\":\"Laws\",\"ja\":\"Laws\"}'),
           ('{\"en\":\"Policy\",\"ja\":\"Policy\"}'),
           ('{\"en\":\"Locations\",\"ja\":\"Locations\"}'),
           ('{\"en\":\"Services\",\"ja\":\"Services\"}'),
           ('{\"en\":\"How To Use\",\"ja\":\"How To Use\"}'),
           ('{\"en\":\"Booking\",\"ja\":\"Booking\"}');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faq_categories');
    }
}
