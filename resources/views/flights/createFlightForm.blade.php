@extends('layouts.app2')

@section('content')
<div class="content-wrapper">
    <div class="form-container">
        <h2 class="form-title">Create Flight</h2>
        <form action="{{ route('flightStore') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="departure">Departure:</label>
                <input type="text" name="departure" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="arrival">Arrival:</label>
                <input type="text" name="arrival" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="plane_id">Plane ID:</label>
                <input type="number" name="plane_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reserved">Places reserved:</label>
                <input type="number" name="reserved" class="form-control" required>
            </div>
            <button type="submit" class="btn-submit">Create Flight</button>
        </form>
    </div>
</div>
@endsection