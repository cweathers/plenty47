<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    protected $fillable = [
	    'fundraiser_id',
	    'firstName',
	    'lastName',
    ];
    
    protected $table = 'salespeople';
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
        
    public function fundraiser()
    {
	    return $this->hasOne('App\Fundraiser', 'id', 'vendor_id');
    }

}
