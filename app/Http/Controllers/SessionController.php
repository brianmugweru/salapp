<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class SessionController extends Controller
{
    /*
     * MIDDLEWARE TO PREVENT LOGGED IN USERS FROM VIEWING LOGIN PAGE
     */
    public function __construct()
    {
        $this->middleware('guest',['except'=>'destroy']);
    }
    /*
     * CONTROLLER TO RENDER LOGIN TEMPLATE
     *
     */
    public function create()
    {
        return view('auth.login');
    }

    
    /*
     * AUTHENTICATE USER CONTROLLER
     *
     */
    public function authenticate()
    {
        if(\Auth::attempt(request(['email','password'])))
        {
            if(\Auth::user('role') == "salon")
            {
                return redirect()->home();
            }
            else if(\Auth::User('role') == "normal")
            {
                return redirect()->home();
            }
        }
        else{
            return back()->withErrors([
                'message'=>'please check your credentials and check again'
            ]);
        }
    }


    /*
     * LOGOUT CONTROLLER
     *
     */
    public function destroy()
    {
        auth()->logout();
        return redirect()->home();
    }

    /*
     * RENDER PASSWORD RESET TEMPLATE CONTROLLER
     *
     */
    public function passwordreset()
    {
        return view('auth.passwords.email');
    }

    /*
     * SEND PASSWORD RESET LINK
     *
     */
    public function sendresetlink(){
        //recieve post object and send link to persaid emal
    }
}
