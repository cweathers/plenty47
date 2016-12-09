<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
	    'category'
    ];
    
    protected $hidden = array(
        'remember_token',
        'created_at',
        'updated_at'
    );
}
