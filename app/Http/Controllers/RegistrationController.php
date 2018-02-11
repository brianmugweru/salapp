<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class RegistrationController extends Controller
{
    /*
     * Controller for registration view page
     */
    public function create()
    {
        return view('auth.register');
    }

    /*
     * Controller to store user credentials
     * and Login user into session
     *
     */
    public function store(Request $request)
    {
        //Validate the user
        $errors = $request->validate(User::$rules);

        //Create  and save the user
        $user = User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>bcrypt($request['password']),
            'role'=>$request['role'],
        ]);

        //Sign them in 
        auth()->login($user);

        //Redirect to homepage
        if(\Auth::user('role') == "salon")
            return redirect()->salon();
        else
            return redirect()->home();

    }
}
