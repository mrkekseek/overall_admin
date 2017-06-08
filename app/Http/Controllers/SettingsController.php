<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\User;
use App\Role;
use App\Countries;
use App\User_statuses;

class SettingsController extends Controller
{
    public function add($id = FALSE)
    {
        $roles = Role::all();
        $user = User::find($id);
        $countries = Countries::all();
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
        $user->country = $country['full_name'];
        $user->phone_number = $data['phone_number'];
        $user->user_status = $user_status['status_name'];
        if ( ! empty($data['password']))
        {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        $user->roles()->sync([$data['role']]);

        return redirect('settings/users')->with('message', 'User was succesfully saved');
    }

    public function users()
    {
        $users = User::all();
        return compact('users');
    }

    public function details($id = FALSE)
    {
        $user = User::find($id);

        return compact('user');
    }
}
