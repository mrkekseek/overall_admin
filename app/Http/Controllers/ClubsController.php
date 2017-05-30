<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Carbon\Carbon;
use App\Club_account;
use App\Club_owner;
use App\Sport;
use App\Address;

class ClubsController extends Controller
{
    public function add($id = FALSE)
    {
        $owners = $this->clubsOwnersGet();
        $sports = Sport::all();
        $club = Club_account::find($id);
        if ( ! empty($club))
        {
            $club->address = Address::find($club->address_id);
        }
        return compact('club', 'sports', 'owners');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'name' => 'required|max:150',
            'owner_id' => 'required',
            'address1' => 'required|max:45',
            'address2' => 'max:45',
            'city' => 'required|max:45',
            'region' => 'required|max:45',
            'zipcode' => 'required|max:45',
            'country' => 'required|max:45'
        ], [
            'owner_id.required' => 'The Club owner field is required.'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    	$club = Club_account::firstOrNew(['id' => $id]);
        $club->address_id = $this->addressSave($club->address_id, $data);
    	$club->name = $data['name'];
    	$club->owner_id = $data['owner_id'];
    	$club->main_sport_id = $data['main_sport_id'];
        $club->details = $data['details'];
        $club->subdomain_specific_id = time();
    	$club->save();

        return redirect('clubs/lists')->with('message', 'Club was succesfully saved');
    }

    public function lists()
    {
        $clubs = Club_account::latest()->get();
        $minDate = strtotime('-7 days');
        foreach ($clubs as $club)
        {
            $club['signupFlag'] = $club->created_at->timestamp >= $minDate;
            $club['address'] = Address::find($club->address_id);
            $club['sport'] = Sport::find($club->main_sport_id);
            $club['owner'] = Club_owner::find($club->owner_id);
        }
        return view('clubs/lists')->with(compact('clubs'));
    }

    public function details($id = FALSE)
    {
        $club = Club_account::find($id);
        return compact('club');
    }

    public function remove($id = FALSE)
    {
        Club_account::destroy($id);
        return redirect('clubs/lists')->with('message', 'Club was successfully removed');
    }

    public function clubsOwnersGet()
    {
        return Club_owner::all();
    }

    public function clubsOwnersSave($id = FALSE, $data = [])
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required|unique:club_owners,email_address'
        ]);

        $owner = new Club_owner;
        $owner->first_name = $data['first_name'];
        $owner->last_name = $data['last_name'];
        $owner->middle_name = $data['middle_name'];
        $owner->country = $data['country'];
        $owner->email_address = $data['email_address'];
        $owner->phone_number = $data['phone_number'];
        $owner->save();

        return $owner->id;
    }

    public function addressSave($id, $data)
    {
        $address = Address::firstOrNew(['id' => $id]);
        $address->address1 = $data['address1'];
        $address->address2 = $data['address2'];
        $address->city = $data['city'];
        $address->region = $data['region'];
        $address->zipcode = $data['zipcode'];
        $address->country = $data['country'];
        $address->details = $data['address_details'];
        $address->save();
        return $address->id;
    }
}
