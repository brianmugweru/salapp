<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Salon;

use App\User;

use App\Like;

use App\Style;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('getlikedsalons');
    }

    public function redirect()
    {
        return auth()->user()->role == 'salon' ? redirect('/salon') : redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $salons = Salon::orderBy('rank','desc')
            ->take(4)
            ->get();

        return view('welcome')->withSalons($salons);
    }

    public function getsalon($id)
    {
        $salon = Salon::find($id);

        return view('single')->withSalon($salon);
    }

    public function like($salon_id, $user_id)
    {
        $salon = Salon::find($salon_id);

        $user = User::find($user_id);

        $salon->addRank();
    

        $like = new Like;

        $like->user_id = $user_id;

        $like->salon_id = $salon_id;

        $like -> save();

        return redirect('/salon/'.$salon_id.'/book');
    }

    public function getlikedsalons()
    {
        //$likes = Like::all();
        $likes = Like::where('user_id', auth()->user()->id)->get();

        return view('liked')->withLikes($likes);
    }

    public function getstyle()
    {
        $styles = Style::all();

        return view('styles')->withStyles($styles);
    }
}
