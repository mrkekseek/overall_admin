<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club_owner extends Model
{
    protected $guarded = [];

    function country_code()
    {
    	return $this->hasOne('App\Countries', 'iso_3166_2', 'country');
    }
}
