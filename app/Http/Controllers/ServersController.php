<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Server;
use App\Subdomain_specific;

class ServersController extends Controller
{
    public function add($id = FALSE)
    {
        $server = Server::find($id);
        return compact('server');
    }

    public function addPost($id = FALSE, $data = [])
    {
    	$validator = Validator::make($data, [
            'ip_address' => 'required|unique:servers,ip_address,'.$id
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    	$server = Server::firstOrNew(['id' => $id]);
        $server->ip_address = $data['ip_address'];
        $server->server_type = $data['server_type'];
    	$server->perfomance_level = $data['perfomance_level'];
    	$server->description = $data['description'];
    	$server->save();

        return redirect('servers/lists')->with('message', 'Server was succesfully saved');
    }

    public function lists()
    {
        $servers = Server::latest()->get();
        return view('servers/lists')->with(compact('servers'));
    }

    public function details($id = FALSE)
    {
        $server = Server::find($id);
        $subdomains = Subdomain_specific::where(['web_server_id' => $id])->get();
        return compact('server', 'subdomains');
    }

    public function remove($id = FALSE)
    {
        Server::destroy($id);
        return redirect('servers/lists')->with('message', 'Server was successfully removed');
    }

    public function filledPost($id = FALSE)
    {
        $server = Server::find($id);

        if (empty($server->is_filled))
        {
            $server->is_filled = '0';
            $message = 'Server is not filled';
        }
        else
        {
            $server->is_filled = '1';
            $message = 'Server is filled';
        }

        $server->save();
        
        return redirect('servers/details/{{$ id }}')->with('message', $message);
    }
}
