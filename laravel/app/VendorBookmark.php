<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendorBookmark extends Model
{
    protected $fillable = [
	    'user_id',
	    'vendor_id'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
