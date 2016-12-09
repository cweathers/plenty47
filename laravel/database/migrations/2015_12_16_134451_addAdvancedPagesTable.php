<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvancedPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanced_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('top_section_image');
            $table->string('top_section_heading');
            $table->string('top_section_subheading');
            $table->text('top_section_text');
            $table->string('top_section_button_text');
            $table->string('top_section_button_link');
            $table->string('blue_section_heading');
            $table->string('qs_left_heading');
            $table->string('qs_left_subheading');
            $table->string('qs_left_icon');
            $table->string('qs_left_image');
            $table->string('qs_leftMiddle_heading');
            $table->string('qs_leftMiddle_subheading');
            $table->string('qs_leftMiddle_icon');
            $table->string('qs_leftMiddle_image');
            $table->string('qs_rightMiddle_heading');
            $table->string('qs_rightMiddle_subheading');
            $table->string('qs_rightMiddle_icon');
            $table->string('qs_rightMiddle_image');
            $table->string('qs_right_heading');
            $table->string('qs_right_subheading');
            $table->string('qs_right_icon');
            $table->string('qs_right_image');
            $table->integer('extra_section_active');
            $table->string('extra_section_left');
            $table->string('extra_section_right');
            $table->string('extra_section_bg_color');
            $table->integer('bottom_section_active');
            $table->string('bottom_section_left');
            $table->string('bottom_section_left_image');
            $table->string('bottom_section_bg_color');
            $table->integer('bottom_bg_section_active');
            $table->string('bottom_bg_section_image');
            $table->string('bottom_bg_section_left');
            $table->text('bottom_bg_section_right');
            $table->integer('last_section_active');
            $table->string('last_section_left');
            $table->text('last_section_right');
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
        Schema::drop('advanced_pages');
    }
}
