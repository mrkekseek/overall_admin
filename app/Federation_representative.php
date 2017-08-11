<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Federation_representative extends Model
{
    function country_code()
    {
    	return $this->hasOne('App\Countries', 'id', 'country');
    }
}
