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
        return auth()->user()->role == 'salon' ? redirect('/dashboard/salon') : redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        if($request->query()){
            $salons =  Salon::whereBetween('latitude',array($request->query('maxlat'), $request->query('minlat')))
                ->whereBetween('longitude', array($request->query('minlng'), $request->query('maxlng')))
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
