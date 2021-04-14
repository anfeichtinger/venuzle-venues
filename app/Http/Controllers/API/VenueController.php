<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;

use App\Http\Requests\AddVenueRequest;

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
    public function add(AddVenueRequest $request)
    {
        $venue = new Venue([
            'name' => $request->name,
            'open_at' => $request->open_at,
            'close_at' => $request->close_at
        ]);
        $venue->save();

        return response()->json($venue, 201);
    }

    // edit venue
    public function edit($id)
    {
        $venue = Venue::find($id);
        return response()->json($venue);
    }

    // update venue
    public function update($id, AddVenueRequest $request)
    {
        $venue = Venue::find($id);
        $venue->update($request->all());

        return response()->json($venue, 200);
    }

    // delete venue
    public function delete($id)
    {
        $venue = Venue::find($id);
        $venue->delete();

        return response()->json(null, 204);
    }
}
