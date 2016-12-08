<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedPage extends Model
{
    //
            
    protected $fillable = [
	    'slug',
	    'top_section_image',
        'top_section_heading',
        'top_section_subheading',
        'top_section_text',
        'top_section_button_text',
        'top_section_button_link',
        'top_section_button_text_2',
        'top_section_button_link_2',
        'blue_section_heading',
        'qs_left_heading',
        'qs_left_subheading',
        'qs_left_icon',
        'qs_left_image',
        'qs_leftMiddle_heading',
        'qs_leftMiddle_subheading',
        'qs_leftMiddle_icon',
        'qs_leftMiddle_image',
        'qs_rightMiddle_heading',
        'qs_rightMiddle_subheading',
        'qs_rightMiddle_icon',
        'qs_rightMiddle_image',
        'qs_right_heading',
        'qs_right_subheading',
        'qs_right_icon',
        'qs_right_image',
        'extra_section_active',
        'extra_section_left',
        'extra_section_right',
        'extra_section_bg_color',
        'bottom_section_active',
        'bottom_section_left',
        'bottom_section_left_image',
        'bottom_section_bg_color',
        'bottom_bg_section_active',
        'bottom_bg_section_image',
        'bottom_bg_section_left',
        'bottom_bg_section_right',
        'last_section_active',
        'last_section_left',
        'last_section_right',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
    
    public function lists()
    {
        return $this->hasMany('App\AdvancedContentList', 'id', 'advanced_page_id');
    }
}
