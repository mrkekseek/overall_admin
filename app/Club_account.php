<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club_account extends Model
{
    protected $guarded = [];
    
    public function subdomains()
    {
        return $this->belongsTo('App\Subdomain_specific', 'subdomain_specific_id');
    }

    public function owners()
    {
        return $this->belongsTo('App\Club_owner', 'owner_id');
    }

    public function sport()
    {
        return $this->belongsTo('App\Sport', 'main_sport_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

    public function generate_account_key()
    {
    	return rand(10000,99999).'-'.rand(10000,99999).'-'.rand(10000,99999).'-'.rand(10000,99999).'-'.rand(10000,99999);
    }
}
