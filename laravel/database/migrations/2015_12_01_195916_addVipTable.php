<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('card_number_id');
            $table->string('phone');
            $table->integer('stripe_subscription_id');
            $table->integer('active');
            $table->string('avatar')->nullable();
            $table->string('profileImage')->nullable();
            $table->integer('fundraiser_id');
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
        Schema::drop('vips');
    }
}
