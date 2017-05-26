<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Federation_account;

class FederationsController extends Controller
{
    public function addPost($id = FALSE, $data = [])
    {
    	Validator::make($data, [
            'name' => 'required|max:255|unique',
            'owner_id' => 'max:255',
            'details' => 'max:255'
        ], [
            'tnc.accepted' => 'You must accept Terms of Service'
        ]);

    	$federation = new Federation_account;
    	$federation->name = $data['name'];
    	$federation->owner_id = $data['owner_id'];
    	$federation->country = $data['country'];
    	$federation->subdomain_specific_id = time();
    	$federation->save();
        return redirect('federations/lists')->withErrors('Federation saved');
    }

    public function lists()
    {
        $federations = Federation_account::latest()->get();

        return view('federations/lists')->with(compact('federations'));
    }
}
