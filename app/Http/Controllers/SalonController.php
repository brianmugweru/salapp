<?php

namespace App\Http\Controllers;

use App\Salon;
use App\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class SalonController extends Controller
{
    /**
     * Create a new controller instance for authentication middleware.
     *
     * @return void
     */
 
    public function __construct()
    {
        $this->middleware('auth')->except(['get','search']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salons = Salon::where('user_id', \Auth::User()->id)->get();

        return view('salon.index',compact('salons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salon.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[

            'name'=>'required',

            'longitude'=>'required',

            'latitude'=>'required',

            'image'=>'required',
        ]);

        Auth()->User()->salons()->create([

            'name'=>$request->name,

            'longitude'=>$request->longitude,

            'latitude'=>$request->latitude,

            'opening_time'=>$request->opening_time,

            'closing_time'=>$request->closing_time,

            'image'=>$request->file('image')->store('public/salons')

        ]);

        return redirect('/dashboard/salon');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function show(Salon $salon)
    {
        if(auth()->user()->can('view-salon', $salon))
        {
            return view('salon.show')->withSalon($salon);
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function edit(Salon $salon)
    {
        if(auth()->user()->can('edit-salon', $salon))
        {
            return view('salon.edit')->withSalon($salon);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salon $salon)
    {
        if($request->name) $salon->name = $request->name;

        if($request->longitude) $salon->longitude = $request->longitude;

        if($request->latitude) $salon->latitude = $request->latitude;

        if($request->opening_time) $salon->opening_time = $request->opening_time;

        if($request->closing_time) $salon->closing_time = $request->closing_time;

        if($request->file('image')) $salon->image = $request->file('image')->store('public/salon');

        $salon->save();

        return redirect('/dashboard/salon');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salon $salon)
    {
        $salon->delete();

        return redirect('/dashboard/salon');
    }

    public function get($id)
    {
        $salon = Salon::find($id);

        return view('single')->withSalon($salon);
    }

    public function like($id)
    {
        $salon = Salon::find($salon_id);

        $salon->addRank();

        $like = new Like;

        $like->user_id = auth()->user->id;

        $like->salon_id = $salon_id;

        $like -> save();

        return back;

    }
    public function search(Request $request)
    {

        $salons = Salon::search($request->get('salon'))->orderBy('created_at','DESC')->get();

        return $salons;
    }
}
