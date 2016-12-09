<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialSettings extends Model
{
    protected $fillable = [
	    'link',
	    'icon',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
