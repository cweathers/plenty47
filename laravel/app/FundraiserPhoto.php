<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundraiserPhoto extends Model
{
    protected $fillable = [
	    'fundraiser_id',
	    'photo',
	    'order'
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
