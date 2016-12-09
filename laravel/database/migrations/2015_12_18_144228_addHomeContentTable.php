<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHomeContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('slide_1_bg_image');
		    $table->string('slide_1_heading');
		    $table->string('slide_1_subheading');
		    $table->text('slide_1_text');
		    $table->text('slide_1_btns');
		    $table->string('slide_2_bg_image');
		    $table->string('slide_2_heading');
		    $table->string('slide_2_subheading');
		    $table->text('slide_2_text');
		    $table->text('slide_2_btns');
		    $table->string('slide_3_bg_image');
		    $table->string('slide_3_heading');
		    $table->string('slide_3_subheading');
		    $table->text('slide_3_text');
		    $table->text('slide_3_btns');
		    $table->string('merchant_heading');
		    $table->string('merchant_subheading');
		    $table->text('merchant_text');
		    $table->string('merchant_icon');
		    $table->string('merchant_button_text');
		    $table->string('fundraiser_heading');
		    $table->string('fundraiser_subheading');
		    $table->text('fundraiser_text');
		    $table->string('fundraiser_icon');
		    $table->string('fundraiser_button_text');
		    $table->string('tradeshow_heading');
		    $table->string('tradeshow_subheading');
		    $table->text('tradeshow_text');
		    $table->string('tradeshow_icon');
		    $table->string('tradeshow_button_text');
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
        Schema::drop('home_page_contents');
    }
}
