<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('performer_id');
            $table->tinyInteger('payment_method');
            $table->tinyInteger('type');

            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('phone', 25);


            $table->string('duration');
            $table->tinyInteger('sessions')->default(1);
            $table->date('date');
            $table->string('time_slot');
            $table->text('message');
            $table->unsignedInteger('color_id')->nullable();
            $table->string('stripe_client_secret')->nullable();
            $table->timestamps();

            $table->foreign('performer_id')
                ->references('id')
                ->on('performers')
                ->onDelete('cascade');
        });

        Schema::create('order_service', function (Blueprint $table) {
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('service_id');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');

            $table->unique(['order_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
        Schema::drop('order_service');
    }
}
