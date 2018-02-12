<?php

namespace App\Http\Controllers;

use App\Style;
use App\Salon;
use Illuminate\Http\Request;

class StyleController extends Controller
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
    public function index($salon_id)
    {
        $styles = Style::where('salon_id', $salon_id)->get();

        return view('styles.style', compact($styles));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //form to add new styel to database

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$salon_id)
    {
        // validate request body and store to db
        
        $this->validate(request(),[

            'name'=>'required',

            'time_taken' => 'required',

            'image' => 'required'
        ]);

        $style = new Style;

        $style -> name = $request->name;

        $style -> time_taken = $request->time_taken;

        $style -> image = $request->file('image')->store('public/styles');

        $style -> salon_id = $salon_id;

        $style -> save();
        
        return redirect('/salon/'.$salon_id.'/styles');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function show(Style $style)
    {
        return view('style.show',compact($style))
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function edit(Style $style)
    {
        //get edit page for style
        
        return view('style.edit', compact($style));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Style $style, $salon_id)
    {
        //update specific style in database
        $style = Style::find($sytle->id);

        if($request -> name) $style -> name = $request -> name;

        if($request -> time_taken) $style -> time_taken = $request -> time_taken;

        if($request -> file('image')) $style -> image = $request -> file('image') -> store('public/styles');

        $style -> save();

        return redirect('/salon/'.$salon_id.'/styles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function destroy(Style $style, $salon_id)
    {
        //delete style from database
        $style -> delete();

        return redirect('/salon/'.$salon_id.'/styles');
    }
}
