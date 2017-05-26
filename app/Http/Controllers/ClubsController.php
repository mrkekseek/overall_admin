<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Carbon\Carbon;
use App\Club_account;

class ClubsController extends Controller
{
    public function add($id = FALSE)
    {
        $club = Club_account::find($id);
        return compact('club');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'name' => 'required|max:150',
            'new_owner' => 'required_if:owner_id,0|max:150'
        ], [
            'new_owner.required_if' => 'You should enter name of contact person'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    	$club = Club_account::firstOrNew(['id' => $id]);
    	$club->name = $data['name'];
    	$club->owner_id = $data['owner_id'];
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
}
