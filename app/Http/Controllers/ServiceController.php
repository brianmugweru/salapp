<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        //Open view page for services belonging to specific salon

        $services = Service::where('salon_id', $salon_id)->get();

        return view('services.service',compact($services));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //form to add new service to database
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $salon_id)
    {
        $this->validate(request(),[

            'name' => 'required',

            'time_taken' => 'required',

            'image' => 'required'
        ]);

        $service = new Service;

        $service -> name = $request->name;

        $service -> time_taken = $request -> time_taken;

        $service -> image = $request -> file('image') -> store('public/services');

        $service -> salon_id = $salon_id;

        $service -> save();

        return redirect('/salon/'.$salon_id.'/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //Return view to show single service 
        
        return view('service.show', compact($service));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //Return view to edit service

        return  view('service.edit', compact($service));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service, $salon_id)
    {
        $service = Service::find($service->id);

        if($request -> name) $service->name = $request->name;

        if($request -> time_taken) $service -> time_taken = $request -> time_taken;

        if($request -> file('image')) $service -> image = $request -> file('image') -> store('public/services');

        $service -> save();

        return redirect('/salon/'.$salon_id.'/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        $service -> delete();

        return redirect('/services'.$service_id.'/services');
    }
}
