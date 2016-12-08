<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $fillable = [
	    'vimeo_id',
	    'slide_1_bg_image',
	    'slide_1_heading',
	    'slide_1_subheading',
	    'slide_1_text',
	    'slide_1_btns',
	    'slide_1_video',
	    'slide_2_bg_image',
	    'slide_2_heading',
	    'slide_2_subheading',
	    'slide_2_text',
	    'slide_2_btns',
	    'slide_2_video',
	    'slide_3_bg_image',
	    'slide_3_heading',
	    'slide_3_subheading',
	    'slide_3_text',
	    'slide_3_btns',
	    'slide_3_video',
	    'merchant_heading',
	    'merchant_subheading',
	    'merchant_text',
	    'merchant_icon',
	    'merchant_button_text',
	    'fundraiser_heading',
	    'fundraiser_subheading',
	    'fundraiser_text',
	    'fundraiser_icon',
	    'fundraiser_button_text',
	    'tradeshow_heading',
	    'tradeshow_subheading',
	    'tradeshow_text',
	    'tradeshow_icon',
	    'tradeshow_button_text',
    ];
    
    protected $hidden = array(
        'remember_token',
        'created_at',
        'updated_at'
    );
}
