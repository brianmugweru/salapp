<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance for authentication middleware.
     *
     * @return void
     */
 
    public function __construct()
    {
        $this->middleware('auth')->except(['get']);
    }

    public function index()
    {
        return view('profile.index');
    }
    public function edit()
    {
        return view('profile.edit');
    }
    public function update(User $user,Request $request)
    {
        $user->update(array_filter($request->all()));

        return redirect('/profile');
    }
}
