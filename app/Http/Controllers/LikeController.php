<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Salon;

use App\User;

use App\Like;

class LikeController extends Controller
{
    /**
     * Create a new controller instance for authentication middleware.
     *
     * @return void
     */
 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function salons()
    {
        $likes = Like::where('user_id', auth()->user()->id)->get();

        return view('liked')->withLikes($likes);
    }

}
