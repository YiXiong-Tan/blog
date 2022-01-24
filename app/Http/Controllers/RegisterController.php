<?php

namespace App\Http\Controllers;

use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // validate - make sure form input is in particular format
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
//            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'email' => 'required|email|max:255|unique:users,email', //
            'password' => 'required|min:7|max:255',
        ]);

        // create the user
        // eloquent mutator - encrypts the password before creating the user
        $user = User::create($attributes);

        // login the user
        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created');
    }
}
