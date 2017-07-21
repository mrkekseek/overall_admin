<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\User;
use App\Role;
use App\Countries;
use App\User_statuses;
use Regulus\ActivityLog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Activity_log;

class SettingsController extends Controller
{
    public function add($id = FALSE)
    {
        $roles = Role::all();
        $user = User::find($id);
        $countries = Countries::orderBy('name', 'asc')->get();
        $user_statuses = User_statuses::all();

        return compact('user', 'roles', 'countries', 'user_statuses');
    }

    public function addPost($id = FALSE, $data = [])
    {
        $data['id'] = $id;
        $validator = Validator::make($data, [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required_without:id',
            'country' => 'required|max:45',
            'user_status' => 'required|max:45'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $country = Countries::find($data['country']);
        $user_status = User_statuses::find($data['user_status']);

        $user = User::firstOrNew(['id' => $id]);
        $user->name = $data['name'];
        $user->username = $data['email'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->country = $country['name'];
        $user->phone_number = $data['phone_number'];
        $user->user_status = $user_status['status_name'];
        if ( ! empty($data['password']))
        {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        $user->roles()->sync([$data['role']]);

         if (empty($id))
        {
            Activity::log([
                'contentId'   => Auth::id(),
                'contentType' => 'User',
                'action'      => 'Add',
                'description' => 'Add a new User',
                'details'     => 'User name: '.$user->name,
                'updated'     => FALSE,
            ]);
        }
        else
        {
             Activity::log([
                'contentId'   => Auth::id(),
                'contentType' => 'User',
                'action'      => 'Create',
                'description' => 'Created a User',
                'details'     => 'User name: '.$user->name,
                'updated'     => TRUE,
            ]);
        }

        return redirect('settings/users')->with('message', 'User was succesfully saved');
    }

    public function edit($id = FALSE)
    {
        $roles = Role::all();
        $user = User::find($id);
        $countries = Countries::orderBy('name', 'asc')->get();
        $user_statuses = User_statuses::all();

        return compact('user', 'roles', 'countries', 'user_statuses');
    }

    public function users()
    {
        $users = User::all();
        return compact('users');
    }

    public function details($id = FALSE)
    {
        $user = User::find($id);
        $logs = Activity_log::where(['content_id' => $id])->get();
        return compact('user', 'logs');
    }
}
