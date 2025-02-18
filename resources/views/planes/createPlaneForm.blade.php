@extends('layouts.app2')

@section('content')
<div class="content-wrapper">
    <div class="form-container">
        <h2 class="form-title">Create Plane</h2>
        <form action="{{ route('planeStore') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="max_capacity">Available places:</label>
                <input type="number" name="max_capacity" class="form-control" required>
            </div>
            <button type="submit" class="btn-submit">Create Flight</button>
        </form>
    </div>
</div>
@endsection