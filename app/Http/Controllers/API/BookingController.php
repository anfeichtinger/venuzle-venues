<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // all bookings
    public function index()
    {
        $bookings = Booking::all()->toArray();
        return array_reverse($bookings);
    }

    // add booking
    public function add(Request $request)
    {
        
        $booking = new Booking([
            'customer' => $request->customer,
            'bookingTime' => $request->bookingTime,
            'venue_id' => $request->venue_id
        ]);
        $booking->save();

        return response()->json('The booking was successfully added');
    }

    // edit booking
    public function edit($id)
    {
        $booking = Booking::find($id);
        return response()->json($booking);
    }

    // update booking
    public function update($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());

        return response()->json('The booking was successfully updated');
    }

    // delete booking
    public function delete($id)
    {
        $booking = Booking::find($id);
        $booking->delete();

        return response()->json('The booking was successfully deleted');
    }
    // all bookings for venue_id
    public function venueBookings($venue_id)
    {
        $bookings = Booking::where('venue_id', $venue_id);
        return array_reverse($bookings);
    }
}
