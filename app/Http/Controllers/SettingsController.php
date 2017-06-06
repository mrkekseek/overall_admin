<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\User;
use App\Role;
use App\Countries;

class SettingsController extends Controller
{
    public function add($id = FALSE)
    {
        $roles = Role::all();
        $user = User::find($id);
        $countries = Countries::all();
        return compact('user', 'roles', 'countries');
    }

    public function addPost($id = FALSE, $data = [])
    {
        $data['id'] = $id;
        $validator = Validator::make($data, [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required_without:id',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::firstOrNew(['id' => $id]);
        $user->name = $data['name'];
        $user->username = $data['email'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->country = $data['country'];
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
}
