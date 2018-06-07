<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('offer_id');
            $table->integer('offer_author');
            $table->integer('trade_author');
            $table->string('amount_fiat');
            $table->string('amount_btc');
            $table->string('exchange_rate');
            $table->boolean('payment_status');
            $table->boolean('trade_status');
            $table->integer('canceled_by');
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
        Schema::dropIfExists('trades');
    }
}
