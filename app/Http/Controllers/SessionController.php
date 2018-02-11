<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class SessionController extends Controller
{
    /**
     * Create a new controller instance for guest middleware view login page.
     *
     * @return void
     *
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
        $this -> validate(request(), User::$sessionrules);

        if(\Auth::attempt(request(['email','password'])))
        {
            if(\Auth::user()->role == "salon")
            {
                return redirect('/salon');
            }
            else if(\Auth::User()->role == "normal")
            {
                return redirect()->home();
            }
        }
        else
        {
            return back()->withErrors([
                'message'=>'login failed, check credentials and try again'
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
