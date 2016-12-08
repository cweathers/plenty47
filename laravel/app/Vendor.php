<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
	    'user_id',
	    'companyName',
	    'category',
	    'phone',
	    'address',
	    'address2',
	    'city',
	    'state',
	    'zipcode',
	    'slug',
	    'logo',
	    'active',
	    'profileImage',
	    'market_id',
	    'vimeo_id',
	    'url'
    ];
    
    protected $hidden = array(
        'remember_token',
        'created_at',
        'updated_at'
    );
    
    public function facts()
    {
        return $this->hasMany('App\VendorFact');
    }
    
    public function photos()
    {
        return $this->hasMany('App\VendorPhoto');
    }
    
    public function hours()
    {
        return $this->hasMany('App\VendorHour');
    }
    
    public function deals()
    {
        return $this->hasMany('App\VendorDeal');
    }
    
    public function market()
    {
	    return $this->hasOne('App\Market', 'id', 'market_id');
    }
    
}
