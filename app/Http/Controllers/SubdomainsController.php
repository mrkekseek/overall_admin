<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Subdomain_specific;

class SubdomainsController extends Controller
{
    public function add($id = FALSE)
    {
        $subdomain = Subdomain_specific::find($id);
        return compact('subdomain');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'subdomain_link' => 'required'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    	$subdomain = Subdomain_specific::firstOrNew(['id' => $id]);
    	$subdomain->subdomain_link = $data['subdomain_link'];
    	$subdomain->save();

        return redirect('subdomains/lists')->with('message', 'Subdomain was succesfully saved');
    }

    public function lists()
    {
        $subdomains = Subdomain_specific::latest()->get();
        return view('subdomains/lists')->with(compact('subdomains'));
    }

    public function details($id = FALSE)
    {
        $subdomain = Subdomain_specific::find($id);
        return compact('subdomain');
    }

    public function remove($id = FALSE)
    {
        Subdomain_specific::destroy($id);
        return redirect('subdomains/lists')->with('message', 'Subdomain was successfully removed');
    }
}
