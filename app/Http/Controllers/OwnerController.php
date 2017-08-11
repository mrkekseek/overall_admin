<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Club_owner;

class OwnerController extends Controller
{
    public function details($id = FALSE)
    {
    	$owner = Club_owner::with('country_code')->where("id", $id)->first();
    	return compact('owner');
    }
}
