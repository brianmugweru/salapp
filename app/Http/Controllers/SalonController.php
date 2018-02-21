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
        $this->middleware('auth');
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
        /* 
         * DOES NOT REQUIRE REQUEST OBJECT BEING PASSED INTO THE PARAMETERS WHEN BEING USED
         * return request();
         */
        $this->validate(request(),[

            'name'=>'required',

            'longitude'=>'required',

            'latitude'=>'required',

            'image'=>'required',
        ]);

       Auth()->User()->addSalon(new Salon([

            'name'=>$request->name,

            'longitude'=>$request->longitude,

            'latitude'=>$request->latitude,

            'opening_time'=>date('H:i:s', strtotime($request->opening_time)),

            'closing_time'=>date('H:i:s', strtotime($request->closing_time)),

            'image'=>$request->file('image')->store('public/salons')

        ]));

        return redirect('/salon');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function show(Salon $salon)
    {
        if(Gate::allows('view-salon', $salon))
        {
            return view('salon.show')->withSalon($salon);
        }else{
            return redirect('/salon');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function edit(Salon $salon)
    {
        if(Gate::allows('view-salon', $salon))
        {
            return view('salon.edit')->withSalon($salon);
        }else{
            return redirect('/salon');
        }
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
        $salon = Salon::find($salon->id);

        if($request->name) $salon->name = $request->name;

        if($request->longitude) $salon->longitude = $request->longitude;

        if($request->latitude) $salon->latitude = $request->latitude;

        if($request->opening_time) $salon->opening_time = date('H:i:s', strtotime($request->get('opening_time')));

        if($request->closing_time) $salon->closing_time = date('H:i:s', strtotime($request->get('closing_time')));

        if($request->file('image')) $salon->image = $request->file('image')->store('public/salon');

        $salon->save();

        return redirect('/salon');

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

        return redirect('/salon');
    }
}
