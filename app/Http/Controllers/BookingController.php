<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Salon;

use App\Booking;

class BookingController extends Controller
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

    /*
     * RENDERS ALL OF USERS BOOKINGS TO PAGE
     */
    public function index()
    {
        $bookings = Booking::selectRaw('salon_id,count(*) booking')
            ->groupBy('salon_id')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('booking.index', compact('bookings'));
    }
    /*
     * RENDERS BOOKING FORM FOR USER TO FILL IN SPECIFICS AND BOOK
     */
    public function create($salon_id)
    {
        $salons = Salon::find($salon_id);

        return view('salon.index')->withSalons($salons);
    }

    /*
     * STORES BOOKING FIELDS FROM USER INTO DATABASE
     */
    public function store(Request $request, Salon $salon)
    {
        $this->validate(request(),[
            'style'=>'required',

            'time'=>'required'
        ]);

        $salon->bookings()->create([
            'style'=>$request->style,

            'time'=>date('Y-m-d H:i:s', strtotime($request->time)),

            'user_id'=>auth()->id()
        ]);

        return redirect('/salon/'.$salon->id);
    }

}
