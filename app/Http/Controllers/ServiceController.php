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
        return view('services.service');
    }

    public function getServices($salon_id)
    {
        $services = Service::where('salon_id', $salon_id)->get();

        return response()->json($services);
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
    public function store(Request $request)
    {
        $errors = $this->validate(request(),[

            'name' => 'required',

            'time_taken' => 'required',

            'image' => 'required'
        ]);

        if($request->hasFile('image')){

            $service = new Service([

                'name' => $request->name,

                'time_taken' => $request -> time_taken,

                'image' => $request -> file('image') -> store('public/services'),

                'salon_id' => $request->salon_id

            ]);

            if($service -> save()){
                return response()->json($service);
            }
        }else{
            return response()->json('err', 'request has no file');
        }

        //return redirect('/salon/'.$salon_id.'/services');
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
    public function edit($id)
    {
        //Return view to edit service

        $service = Service::where('id',$id)->get();

        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if($request -> name) $service->name = $request->name;

        if($request -> time_taken) $service -> time_taken = $request -> time_taken;

        if($request -> file('image')) $service -> image = $request -> file('image') -> store('public/services');

        $service -> save();

        //return redirect('/salon/'.$salon_id.'/services');
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete service from database

        $service = Service::find($id);

        $service -> delete();

        return response()->json('successfully deleted');
    }
}
