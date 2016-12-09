<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
	    'market',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
