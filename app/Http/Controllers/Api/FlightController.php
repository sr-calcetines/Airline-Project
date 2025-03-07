<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();

        return response()->json($flights, 200);
    }

    public function store(Request $request)
    {
        $flight = Flight::create([
            'date' => $request->date,
            'departure' => $request->departure,
            'arrival' => $request->arrival,
            'plane_id' => $request->plane_id,
            'reserved' => $request->reserved,
            'aviable' => $request->aviable
        ]);

        $flight->save();

        return response()->json($flight, 200);
    }
    public function show(string $id)
    {
        $flight = Flight::findOrFail($id);

        return response()->json($flight, 200);
    }

    public function update(Request $request, string $id)
    {
        $flight = Flight::findOrFail($id);

        $flight->update([
            'date' => $request->date,
            'departure' => $request->departure,
            'arrival' => $request->arrival,
            'plane_id' => $request->plane_id,
            'reserved' => $request->reserved,
            'aviable' => $request->aviable
        ]);
        
        $flight->save();

        return response()->json($flight, 200);
    }

    public function destroy(string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();
    }
}
