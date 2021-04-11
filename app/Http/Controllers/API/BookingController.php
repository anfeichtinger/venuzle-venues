<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    // all bookings
    public function index()
    {
        $bookings = Booking::all()->toArray();
        return array_reverse($bookings);
    }

    // add booking
    public function add(StoreBookingRequest $request)
    {
        $booking = new Booking([
            'customer' => $request->customer,
            'booking_begin' => $request->booking_begin,
            'booking_end' => $request->booking_end,
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
    public function update($id, StoreBookingRequest $request)
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
        $bookings = Booking::all()->where('venue_id', $venue_id)->toArray();
        return array_reverse($bookings);
    }
}
