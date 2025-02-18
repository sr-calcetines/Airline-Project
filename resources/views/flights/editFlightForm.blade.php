@extends('layouts.app2')

@section('content')
<div class="content-wrapper">
    <div class="form-container">
        <h2 class="form-title">Edit Flight</h2>
        <form action="{{ route('flightUpdate', $flights->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" value="{{ $flights->date }}" required>
            </div>
            <div class="form-group">
                <label for="departure">Departure:</label>
                <input type="text" name="departure" class="form-control" value="{{ $flights->departure }}" required>
            </div>
            <div class="form-group">
                <label for="arrival">Arrival:</label>
                <input type="text" name="arrival" class="form-control" value="{{ $flights->arrival }}" required>
            </div>
            <div class="form-group">
                <label for="plane_id">Plane ID:</label>
                <input type="number" name="plane_id" class="form-control" value="{{ $flights->plane_id }}" required>
            </div>
            <div class="form-group">
                <label for="reserved">Places reserved:</label>
                <input type="number" name="reserved" class="form-control" value="{{ $flights->reserved }}" required>
            </div>
            <button type="submit" class="btn-submit">Update Flight</button>
        </form>
    </div>
</div>
@endsection