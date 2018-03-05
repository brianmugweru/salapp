<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

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
        return auth()->user()->role == 'salon' ? redirect('/dashboard/salon') : redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         /*
          * GET THOSE IN BETWEEN MAP VIEW BOX THEN SORT ACCORDING TO DISTANCE FROM THE USER 
          */
         if($request->filled(['maxlat','minlat', 'user_lat', 'user_lng'])){
            $salons = Salon::between(request(['maxlat','minlat', 'minlng', 'maxlng']))
                ->distance(request(['user_lat','user_lng']))
                ->get();
        }

        if($request->filled(['maxlat','minlat'])){
            $salons = Salon::between(request(['maxlat','minlat', 'minlng', 'maxlng']))
                ->get();

            return $salons;
        }

        if($request->filled(['user_lat', 'user_lng'])){
            $salons = Salon::distance(request(['user_lat','user_lng']))
                ->get();

           return $salons;
        }

        $salons = Salon::orderBy('rank','desc')
            /*->take(4)*/
            ->get();

        return view('welcome')->withSalons($salons);
    }

    public function getstyle()
    {
        $styles = Style::all();

        return view('styles')->withStyles($styles);
    }
}
