<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    protected $fillable = [
	    'user_id',
	    'card_number_id',
	    'phone',
	    'stripe_subscription_id',
	    'active',
	    'avatar',
	    'profileImage',
	    'fundraiser_id',
	    'salesperson_id',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
    
    public function card()
    {
	    return $this->hasOne('App\CardNumber', 'id', 'card_number_id');
    }
    
    public function fundraiser()
    {
	    return $this->hasOne('App\Fundraiser', 'id', 'fundraiser_id');
    }
    
    public function addresses()
    {
	    return $this->hasMAny('App\Address');
    }
    
    public function salesperson()
    {
	    return $this->hasOne('App\Salesperson', 'id', 'salesperson_id');
    }
    
    public function user()
    {
	    return $this->hasOne('App\User', 'id', 'user_id');
    }
    
}
