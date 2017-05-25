<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Club_account;

class ClubsController extends Controller
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

    	$club = new Club_account;
    	$club->name = $data['name'];
    	$club->owner_id = $data['owner_id'];
    	$club->details = $data['details'];
    	$club->subdomain_specific_id = time();
    	$club->save();
        return redirect('clubs/lists')->withErrors('Club saved');
    }

    public function lists()
    {
        $clubs = Club_account::latest()->limit(7)->get();

        return view('clubs/lists')->with(compact('clubs'));
    }
}
