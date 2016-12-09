<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorHour extends Model
{
    protected $fillable = [
	    'vendor_id',
	    'label',
	    'hours',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
