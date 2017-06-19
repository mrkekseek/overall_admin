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
}
