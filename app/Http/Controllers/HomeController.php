<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Salon;

use App\User;
use App\Like;

class HomeController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salons = Salon::all();

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

        return redirect('/salon/2/book');

    }
}
