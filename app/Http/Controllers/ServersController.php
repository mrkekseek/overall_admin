<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Server;

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
        return compact('server');
    }

    public function remove($id = FALSE)
    {
        Server::destroy($id);
        return redirect('servers/lists')->with('message', 'Server was successfully removed');
    }
}
