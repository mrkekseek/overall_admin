<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class SettingsController extends Controller
{
    public function addNewUserPost($id = FALSE, $data = [])
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required'
        ]);

        $user = new User;
        $user->name = $data['first_name'].' '.$data['last_name'];
        $user->username = $data['email_address'];
        $user->email = $data['email_address'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->country = $data['country'];
        $user->save();
    }
}
