<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::All();

        return view('flights', compact('flights.flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if( Auth::user()->isAdmin=true){

            return view('flights.createFlightForm');

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flight = Flight::create([
            'date' => $request->date,
            'departure' => $request->departure,
            'arrival' => $request->arrival,
            'plane_id' => $request->plane_id,
            'aviable' => $request->aviable
        ]);
        $flight->save();

        return redirect()->route('flights.flights');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $booked = count($flight->users()->where("user_id", Auth::id())->get());

        if ($request->action === "book" && !$booked)
        {
            $this->book($flight, Auth::id());
            return (Redirect::to(route("flights.flightShow", $flight->id)));
        }
        if ($request->action == "debook" && $booked)
        {
            $this->debook($flight, Auth::id());
            return (Redirect::to(route("flights.flightShow", $flight->id)));
        }
        return (view("flights.flightShow", compact("flight", "booked")));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        if( Auth::user()->isAdmin=true){

            $flight = Flight::find($id);
            return view('flights.editFlightForm', compact('flight'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flight = Flight::find($id);

        $flight->update([
            'date' => $request->date,
            'departure' => $request->departure,
            'arrival' => $request->arrival,
            'plane_id' => $request->plane_id,
            'aviable' => $request->aviable
        ]);

        $flight->save();
        return redirect()->route('flights');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if( Auth::user()->isAdmin=true){

            $flight = Flight::find($id);
            $flight->delete();

        }
    }
}
