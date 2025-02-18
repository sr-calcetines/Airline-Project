@extends('layouts.app2')

@section('content')
<div class="content-wrapper">
    <div class="form-container">
        <h2 class="form-title">Edit Plane</h2>
        <form action="{{ route('planeUpdate', $plane->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $plane->name }}" required>
            </div>
            <div class="form-group">
                <label for="max_capacity">Available places:</label>
                <input type="number" name="max_capacity" class="form-control" value="{{ $plane->max_capacity }}" required>
            </div>
            <button type="submit" class="btn-submit">Update Plane</button>
        </form>
    </div>
</div>
@endsection
