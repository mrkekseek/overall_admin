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
use App\Countries;
use Regulus\ActivityLog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Subdomain_specific;
use App\Http\Libraries\ApiClub;

class ClubsController extends Controller
{
    public function add($id = FALSE)
    {
        $owners = $this->clubsOwnersGet();
        $sports = Sport::all();
        $club = Club_account::find($id);
        $countries = Countries::orderBy('name', 'asc')->get();
        if (! empty($club) && $club->subdomain_specific_id == '')
        {
            $subdomains = Subdomain_specific::where('id', $club->subdomain_specific_id)->orWhere('is_assigned', 0)->get();
        }
        elseif ( ! empty($club))
        {
            $club->address = Address::find($club->address_id);
            $subdomains = Subdomain_specific::where('id', $club->subdomain_specific_id)->get();
        }
        else
        {
            $subdomains = Subdomain_specific::where('is_assigned', 0)->get();
        }

        return compact('countries', 'club', 'sports', 'owners', 'subdomains');
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
        if( ! empty($data['assign_subdomain']))
        {
            $club->subdomain_specific_id = $data['assign_subdomain'];
        }
        $club->account_key = ! $club->exists || empty($club->account_key) ? $club->generate_account_key() : $club->account_key;
        if( ! empty($club->subdomain_specific_id))
        {
            $club->subdomains->update(['is_assigned' => 1]);
        }
       
        $club->save();
        
        if (empty($id))
        {
            Activity::log([
                'contentId'   => Auth::id(),
                'contentType' => 'Club',
                'action'      => 'Add',
                'description' => 'Add a new Club',
                'details'     => 'Club name: '.$club->name,
                'updated'     => FALSE,
            ]);
        }
        else
        {
             Activity::log([
                'contentId'   => Auth::id(),
                'contentType' => 'Club',
                'action'      => 'Create',
                'description' => 'Created a Club',
                'details'     => 'Club name: '.$club->name,
                'updated'     => TRUE,
            ]);
        }



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
        return compact('clubs');
    }

    public function details($id = FALSE)
    {
        $club = Club_account::with('sport', 'subdomains', 'owners', 'address')->find($id);
        return compact('club', 'sport', 'subdomains', 'owners', 'address');
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
        $owner->gender = $data['gender'];
        $owner->date_of_birth = date('Y-m-d', strtotime($data['date_of_birth'])); 
        $owner->save();
        return $owner->id;
    }

    public function addressSave($id, $data)
    {
        $country = Countries::where(['id' => $data['country']])->first();

        $address = Address::firstOrNew(['id' => $id]);
        $address->address1 = $data['address1'];
        $address->address2 = $data['address2'];
        $address->city = $data['city'];
        $address->region = $data['region'];
        $address->zipcode = $data['zipcode'];
        $address->country = $country['name'];
        $address->details = $data['address_details'];
        $address->save();

        return $address->id;
    }
    
    public function create_remote_owner($id, $data)
    {
        $club_id = $data['club_id'];
        $club = Club_account::with('owners', 'subdomains')->find($club_id);
        if ( ! empty($club) && ! empty($club->subdomains) && ! empty($club->owners))
        {
            $owner = [
                'first_name' => $club->owners->first_name,
                'middle_name' => $club->owners->middle_name,
                'last_name' => $club->owners->last_name,
                'email_address' => $club->owners->email_address,
                'phone_number' => $club->owners->phone_number,
                'dob' => $club->owners->date_of_birth,
                'gender' => strtoupper($club->owners->gender),
                'country' => $club->owners->country,
            ]; 
            $subdomain = $club->subdomains->subdomain_link;
            return ApiClub::create_owner($owner, $subdomain);
        }
    }
    
    public function create_remote_club($id, $data)
    {
        $club_id = $data['club_id'];
        $club = Club_account::with('address')->find($club_id);
        if ( ! empty($club) && ! empty($club->address) && ! empty($club->subdomains))
        {
            $country = Countries::where('full_name', $club->address->country)->first();
            $remote_club = [
                'account_key' => $club->account_key, 
                'club_details' => [
                    'club_name' => $club->name,
                    'basic_club_details' => $club->details,
                    'default_activity' => $club->main_sport_id,
                ], 
                'club_address' => [
                    'address1' => $club->address->address1, 
                    'address2' => $club->address->address2, 
                    'city' => $club->address->city, 
                    'region' => $club->address->region, 
                    'zip_code' => $club->address->zip_code, 
                    'country' => $country->iso_3166_2,
                    'details' => $club->address->details, 
                ]
            ];
            //dd($remote_club);
            $subdomain = $club->subdomains->subdomain_link;
            return ApiClub::create_club($remote_club, $subdomain);
        }
    }
}
