<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Create a new controller instance for authentication middleware.
     *
     * @return void
     */
 
    public function __construct()
    {
        $this->middleware('auth')->except(['get']);
    }

    /*
     * RENDERS ALL OF USERS BOOKINGS TO PAGE
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();

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
    public function store(Request $request, $salon_id)
    {

    }

}
