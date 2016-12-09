<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVendorDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('title');
            $table->string('tagline');
            $table->text('description');
            $table->text('finePrint');
            $table->text('redemptionInstructions');
            $table->string('largeImage');
            $table->string('squareImage');
            $table->dateTime('expirationDate')->nullable();
            $table->integer('featuredDeal');
            $table->dateTime('featuredExpiration');
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
        Schema::drop('vendor_deals');
    }
}
