<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Subdomain_specific;
use App\Server;

class SubdomainsController extends Controller
{
    public function add()
    {
        $servers = Server::all();
        $web_servers = Server::where(['server_type'=>'web', 'is_filled'=>0])->get();
        $database_servers = Server::where('server_type', 'database')->get();
        return compact('subdomain', 'servers', 'web_servers', 'database_servers');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'subdomain_link' => 'required',
            'web_server' => 'required',
            'database_name' => 'required',
            'database_user' => 'required',
            'database_password' => 'required|min:6'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    	$subdomain = Subdomain_specific::firstOrNew(['id' => $id]);
        $subdomain->subdomain_link = $data['subdomain_link'];
        $subdomain->web_server_id = $data['web_server'];
        $subdomain->database_server_id = $data['database_server'];
        $subdomain->database_name = $data['database_name'];
    	$subdomain->database_user = $data['database_user'];
        $subdomain->database_password = bcrypt($data['database_password']);
    	$subdomain->save();

        return redirect('subdomains/lists')->with('message', 'Subdomain was succesfully saved');
    }

    public function edit($id = FALSE)
    {
        $subdomain = Subdomain_specific::find($id);
        $servers = Server::all();
        $web_servers = Server::where(['server_type'=>'web', 'is_filled'=>0])->get();
        $database_servers = Server::where('server_type', 'database')->get();
        return compact('subdomain', 'servers', 'web_servers', 'database_servers');
    }

    public function lists()
    {
        $subdomains = Subdomain_specific::latest()->get();
        return view('subdomains/lists')->with(compact('subdomains'));
    }

    public function details($id = FALSE)
    {
        $subdomain = Subdomain_specific::with('web_server', 'database_server')->find($id);
        return compact('subdomain');
    }

    public function remove($id = FALSE)
    {
        Subdomain_specific::destroy($id);
        return redirect('subdomains/lists')->with('message', 'Subdomain was successfully removed');
    }
}
