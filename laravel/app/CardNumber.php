<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardNumber extends Model
{
    protected $fillable = [
	    'number',
	    'fundraiser_id',
	    'user_id'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
    
    public function fundraiser()
    {
        return $this->hasOne('App\Fundraiser', 'id', 'fundraiser_id');
    }
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
