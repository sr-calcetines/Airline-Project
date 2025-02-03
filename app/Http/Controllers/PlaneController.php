<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = Plane::All();

        return view('planes', compact('planes.planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if( Auth::user()->isAdmin=true){

            return view('planes.createPlaneForm');

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plane = Plane::create([
            'name' => $request->name,
            'max_capacity' => $request->max_capacity,
            'reserved' => $request->reserved
        ]);
        $plane->save();

        return redirect()->route('planes.planes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plane = Plane::findOrFail($id);
        return view('planeShow', compact('planes.plane'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if( Auth::user()->isAdmin=true){

            $plane = Plane::find($id);
            return view('editPlaneForm', compact('planes.plane'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plane = Plane::find($id);

        $plane->update([
            'name' => $request->name,
            'max_capacity' => $request->max_capacity,
            'reserved' => $request->reserved
        ]);

        $plane->save();
        return redirect()->route('planes.planes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if( Auth::user()->isAdmin=true){

            $plane = Plane::find($id);
            $plane->delete();

        }
    }

    
}
