<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('type');
            $table->string('currency_code',3);
            $table->integer('paymentmethod_id');
            $table->string('paymentmethod_label');
            $table->string('country_code',2);
            $table->integer('margin');
            $table->string('offer_price');
            $table->integer('min_ammount');
            $table->integer('max_ammount');
            $table->integer('payment_window');
            $table->text('offer_terms');
            $table->text('trade_instruction');
            $table->boolean('verified_email');
            $table->boolean('verified_phone');
            $table->boolean('trusted_user');
            $table->integer('past_trades');
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
        Schema::dropIfExists('offers');
    }
}
