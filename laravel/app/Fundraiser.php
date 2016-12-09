<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    protected $fillable = [
	    'user_id',
	    'groupName',
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
	    'aboutUs',
	    'ourCause',
	    'videoLink'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
    
    
    public function facts()
    {
        return $this->hasMany('App\FundraiserFact');
    }
    
    public function photos()
    {
        return $this->hasMany('App\FundraiserPhoto');
    }
    
    public function salespeople()
    {
        return $this->hasMany('App\Salesperson');
    }
    
    
    
}
