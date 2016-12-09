<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFundraiserFactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('fundraiser_facts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fundraiser_id');
            $table->string('fact');
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
        Schema::drop('fundraiser_facts');
    }
}
