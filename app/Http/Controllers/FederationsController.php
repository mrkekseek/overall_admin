<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Federation_account;
use App\Federation_representative;
use App\Sport;
use App\Address;
use App\Countries;

class FederationsController extends Controller
{
    public function add($id = FALSE)
    {
        $owners = $this->federationsOwnersGet();
        $sports = Sport::all();
        $federation = Federation_account::find($id);
        $countries = Countries::all();
        if ( ! empty($federation))
        {
            $federation->address = Address::find($federation->address_id);
        }
        return compact('federation', 'owners', 'sports', 'countries');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'name' => 'required|max:150|unique:federation_accounts,name,'.$id,
            'new_contact_person' => 'required_if:owner_id,0|max:150',
            'address1' => 'required|max:45',
            'address2' => 'max:45',
            'city' => 'required|max:45',
            'region' => 'required|max:45',
            'zipcode' => 'required|max:45',
            'country' => 'required|max:45'
        ], [
            'new_contact_person.required_if' => 'You should enter name of contact person'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    	$federation = Federation_account::firstOrNew(['id' => $id]);
        $federation->address_id = $this->addressSave($federation->address_id, $data);
    	$federation->name = $data['name'];
    	$federation->owner_id = $data['owner_id'];
    	$federation->sport_id = $data['sport_id'];
    	$federation->save();

        Federation_representative::where('federation_id', $federation->id)->update(['is_owner' => '0']);
        $owner = Federation_representative::find($federation->owner_id);
        $owner->federation_id = $federation->id;
        $owner->is_owner = '1';
        $owner->save();

        return redirect('federations/lists')->with('message', 'Federation was succesfully saved');
    }

    public function lists()
    {
        $federations = Federation_account::latest()->get();
        foreach ($federations as $federation)
        {
            $federation['address'] = Address::find($federation->address_id);
            $federation['sport'] = Sport::find($federation->sport_id);
            $federation['owner'] = Federation_representative::find($federation->owner_id);
        }
        return compact('federations');
    }

    public function details($id = FALSE)
    {
        $federation = Federation_account::find($id);
        return compact('federation');
    }

    public function remove($id = FALSE)
    {
        Federation_account::destroy($id);
        return redirect('federations/lists')->with('message', 'Federation was successfully removed');
    }

    public function importPost($id = FALSE, $data = [])
    {
        $data['extension'] = strtolower($data['file']->getClientOriginalExtension());
        $validator = Validator::make($data, [
            'file' => 'required',
            'extension' => 'required|in:xls,xlsx'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (request()->hasFile('file') && request()->file->isValid())
        {
            return back()->with('message', 'File was successfully uploaded');
        }
    }

    public function federationsOwnersGet()
    {
        return Federation_representative::all();
    }

    public function federationsOwnersSave($id = FALSE, $data = [])
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required|unique:federation_representatives,email_address'
        ]);

        $owner = new Federation_representative;
        $owner->first_name = $data['first_name'];
        $owner->last_name = $data['last_name'];
        $owner->middle_name = $data['middle_name'];
        $owner->country = $data['country'];
        $owner->email_address = $data['email_address'];
        $owner->phone_number = $data['phone_number'];
        $owner->federation_id = $data['federation_id'];
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
        $address->country = $country['full_name'];
        $address->details = $data['address_details'];
        $address->save();
        return $address->id;
    }
}
