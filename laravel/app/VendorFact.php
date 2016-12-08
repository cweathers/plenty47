<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorFact extends Model
{
    protected $fillable = [
	    'vendor_id',
	    'fact',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
