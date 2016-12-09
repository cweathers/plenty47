<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimplePage extends Model
{
    protected $fillable = [
	    'heading',
	    'subheading',
	    'content'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
