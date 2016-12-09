<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedContentList extends Model
{
    protected $fillable = [
	    'advanced_page_id',
        'show_number',
        'content',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
    
    protected $table = 'advanced_content_lists';
}
