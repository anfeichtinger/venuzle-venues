<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    // all venues
    public function index()
    {
        $venues = Venue::all()->toArray();
        return array_reverse($venues);
    }

    // specific venues
    public function specific($id)
    {
        $venue = Venue::find($id);
        return $venue;
    }

    // add venue
    public function add(Request $request)
    {
        $venue = new Venue([
            'name' => $request->name,
            'openingTimes' => $request->openingTimes
        ]);
        $venue->save();

        return response()->json('The venue was successfully added');
    }

    // edit venue
    public function edit($id)
    {
        $venue = Venue::find($id);
        return response()->json($venue);
    }

    // update venue
    public function update($id, Request $request)
    {
        $venue = Venue::find($id);
        $venue->update($request->all());

        return response()->json('The venue was successfully updated');
    }

    // delete venue
    public function delete($id)
    {
        $venue = Venue::find($id);
        $venue->delete();

        return response()->json('The venue was successfully deleted');
    }
}
