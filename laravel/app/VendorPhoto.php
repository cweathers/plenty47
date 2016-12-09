<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPhoto extends Model
{
    protected $fillable = [
	    'vendor_id',
	    'photo',
	    'order'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
