<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdomain_specific extends Model
{
    protected $guarded = [];

    public function web_server()
    {
        return $this->belongsTo('App\Server' , 'web_server_id');
    }

     public function database_server()
    {
        return $this->belongsTo('App\Server' , 'database_server_id');
    }
}
