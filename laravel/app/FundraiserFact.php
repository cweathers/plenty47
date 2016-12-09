<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundraiserFact extends Model
{
    protected $fillable = [
	    'fundraiser_id',
	    'fact',
    ];
    
    protected $hidden = array(
        'created_at',
        'updated_at'
    );
}
