<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            //exists to check if email exists
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (!auth()->attempt($attributes)) {

            // auth failed

            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.']);
        }

        // prone to session fixation attack
        // fix - regenerate the session
        session()->regenerate();

        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
