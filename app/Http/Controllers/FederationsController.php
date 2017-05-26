<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Federation_account;

class FederationsController extends Controller
{
    public function add($id = FALSE)
    {
        $federation = Federation_account::find($id);
        return compact('federation');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'name' => 'required|max:150|unique:federation_accounts,name,'.$id,
            'new_contact_person' => 'required_if:owner_id,0|max:150'
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
        $validator = Validator::make($data, [
            'file' => 'required'
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
}
