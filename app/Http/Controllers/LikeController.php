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


    public function likeSalon($salon_id)
    {
        $salon = Salon::find($salon_id);

        $salon->addRank();

        $like = new Like;

        $like->user_id = auth()->user()->id;

        $like->salon_id = $salon_id;

        $like -> save();

        return redirect('/salon/'.$salon_id);
    }

    public function salons()
    {
        $likes = Like::where('user_id', auth()->user()->id)->get();

        return view('liked')->withLikes($likes);
    }

}
