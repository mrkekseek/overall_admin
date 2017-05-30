<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Federation_account;
use App\Sport;
use App\Address;

class FederationsController extends Controller
{
    public function add($id = FALSE)
    {
        $federation = Federation_account::find($id);
        $federation->address = Address::find($federation->address_id);
        return compact('federation');
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
    	$federation->country = $data['country'];
    	$federation->save();

        return redirect('federations/lists')->with('message', 'Federation was succesfully saved');
    }

    public function lists()
    {
        $federations = Federation_account::latest()->get();
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
