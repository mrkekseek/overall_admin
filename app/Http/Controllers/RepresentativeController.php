<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Federation_representative;

class RepresentativeController extends Controller
{
    public function details($id = FALSE)
    {
    	$representative = Federation_representative::with('country_code')->where("id", $id)->first();
    	return compact('representative');
    }
}
