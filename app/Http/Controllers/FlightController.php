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
    public function index(Request $request)
    {
        if ($request->action === 'delete') {
            $this->destroy($request->id);
            return redirect()->route('flights');
        }

        $flights = Flight::where('date', '>=', now())->orderBy('date', 'desc')->get();

        return view('flights.flights', compact('flights'));
    }

    public function pastFlights(Request $request)
    {
        if ($request->action === 'delete') {
            $this->destroy($request->id);
            return redirect()->route('pastFlights');
        }

        $pastFlights = Flight::where('date', '<', now())->orderBy('date', 'desc')->get();

        foreach($pastFlights as $flight){
            $flight->update(
                [
                    "reserved" => $flight->plane->max_capacity 
                ]
            );
        }

        return view('flights.pastFlights', compact('pastFlights'));
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
        $flights = Flight::create([
            'date' => $request->date,
            'departure' => $request->departure,
            'arrival' => $request->arrival,
            'plane_id' => $request->plane_id,
            'reserved' => $request->reserved,
            'aviable' => 0
        ]);
        $flights->save();

        return redirect()->route('flights');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $flights = Flight::find($id);
        $booked = count($flights->users()->where("user_id", Auth::id())->get());

        if ($request->action === "book" && !$booked)
        {
            $this->book($flights, Auth::id());
            return (Redirect::to(route("flightShow", $flights->id)));
        }
        if ($request->action == "unbook" && $booked)
        {
            $this->unbook($flights, Auth::id());
            return (Redirect::to(route("flightShow", $flights->id)));
        }
        return (view("flights.flightShow", compact("flights", "booked")));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        if( Auth::user()->isAdmin=true){

            $flights = Flight::find($id);
            return view('flights.editFlightForm', compact('flights'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flights = Flight::find($id);

        $flights->update([
            'date' => $request->date,
            'departure' => $request->departure,
            'arrival' => $request->arrival,
            'plane_id' => $request->plane_id,
            'reserved' => $request->reserved,
            'aviable' => $flights->aviable
        ]);

        $flights->save();
        return redirect()->route('flights');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if( Auth::user()->isAdmin=true){

            $flights = Flight::find($id);
            $flights->delete();

        }
    }

    public function book(Flight $flight, int $userId)
    {
        if ($flight->reserved == $flight->plane->max_capacity)
        {
            return;
        }
        $flight->users()->attach($userId);
        $flight->update(
            [
                "reserved" => $flight->reserved + 1
            ]
        );
        if ($flight->reserved == $flight->plane->max_capacity && !$flight->aviable)
        {
            $flight->update(
                [
                    "aviable" => 1
                ]
            );
        }
    }

    public function unbook(Flight $flight, int $userId)
    {
        if ($flight->reserved == 0) {
            return;
        }

        $flight->users()->detach($userId);

        $flight->update([
            "reserved" => $flight->reserved - 1
        ]);

        if ($flight->aviable) {
            $flight->update([
                "aviable" => 1
            ]);
        }
    }
}
