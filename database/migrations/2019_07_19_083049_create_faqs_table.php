<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            });

        $content = [
            'en' => '< p class="regular" > Credit Card : Visa, MasterCard, American Express, JCB, Visa Electron, Discover . 
    					The total will be charged to your card when the order is shipped . Balenciaga . com features a Fast Checkout option, allowing you to securely save your credit card details so that you do not have to re - enter them for future purchases .< / p > 
                    < p class="regular" > PayPal : Shop easily online without having to enter your credit card details on the website . 
    					Your account will be charged once the order is completed . To register for a PayPal account, visit the website paypal . com .< / p > ',
            'ja' => '< p class="regular" > Credit Card : Visa, MasterCard, American Express, JCB, Visa Electron, Discover . 
    					The total will be charged to your card when the order is shipped . Balenciaga . com features a Fast Checkout option, allowing you to securely save your credit card details so that you do not have to re - enter them for future purchases .< / p > 
                        < p class="regular" > PayPal : Shop easily online without having to enter your credit card details on the website . 
    					Your account will be charged once the order is completed . To register for a PayPal account, visit the website paypal . com .< / p > '
        ];

        \Illuminate\Support\Facades\DB::unprepared("
        INSERT INTO `faqs` (`category_id`, `title`, `content`) VALUES
            (1,	'{\"en\":\"PAYMENT METHODS\",\"ja\":\"PAYMENT METHODS\"}', NULL),
            (1,	'{\"en\":\"PAYMENT SECURITY\",\"ja\":\"PAYMENT SECURITY\"}', NULL),
            (1,	'{\"en\":\"WHY CAN I NOT COMPLETE MY ORDER?\",\"ja\":\"WHY CAN I NOT COMPLETE MY ORDER?\"}', NULL),
            (1,	'{\"en\":\"WHEN WILL MY CREDIT CARD BE CHARGED?\",\"ja\":\"WHEN WILL MY CREDIT CARD BE CHARGED?\"}', NULL),
            (1,	'{\"en\":\"WHY IS THE AMOUNT I PAID DIFFERENT FROM THE AMOUNT OF MY ORDER?\",\"ja\":\"WHY IS THE AMOUNT I PAID DIFFERENT FROM THE AMOUNT OF MY ORDER?\"}', NULL),
            (1,	'{\"en\":\"WHY DID YOU CHARGE ME TWICE EVEN THOUGH I PLACED ONLY ONE ORDER?\",\"ja\":\"WHY DID YOU CHARGE ME TWICE EVEN THOUGH I PLACED ONLY ONE ORDER?\"}', NULL);
        ");

        \App\Faq::find(1)->update(['content' => $content]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faqs');
    }
}
