<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
	    'label',
	    'user_id',
	    'address',
	    'address2',
	    'city',
	    'state',
	    'zipcode',
	    'type',
	    'active'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
