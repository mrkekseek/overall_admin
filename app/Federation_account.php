<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Federation_account extends Model
{
    protected $guarded = [];

    public function countries()
    {
        return $this->belongsToMany('App\Countries', 'federation_countries', 'federation_id', 'country_id')->withTimestamps();
    }
    
    public function subdomains()
    {
        return $this->belongsTo('App\Subdomain_specific', 'subdomain_specific_id');
    }
    
    public function owners()
    {
        return $this->belongsTo('App\Federation_representative', 'owner_id');
    }

    public function generate_account_key()
    {
    	return rand(10000,99999).'-'.rand(10000,99999).'-'.rand(10000,99999).'-'.rand(10000,99999).'-'.rand(10000,99999);
    }
}
