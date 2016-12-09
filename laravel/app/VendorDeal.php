<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorDeal extends Model
{
    protected $fillable = [
	    'vendor_id',
	    'title',
	    'tagline',
	    'description',
	    'finePrint',
	    'redemptionInstructions',
	    'largeImage',
	    'squareImage',
	    'expirationDate',
	    'featuredDeal',
	    'featuredExpiration'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
    
    public function vendor()
    {
        return $this->hasOne('App\Vendor', 'id', 'vendor_id');
    }
}
