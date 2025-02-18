@extends('layouts.app2')

@section('content')

<div class="body" id="bodyShow">
    <div class="plane-card">
        <div class="card-content-plane">
            <h2 class="card-title">Plane Details</h2>
            <div class="plane-show-div">
                <img src={{asset ("img/logo_inverted.png")}} alt="Plane" class="plane-show-img">
            </div>
            <div class="plane-data-div">
                <p><strong>Name:</strong> {{ $plane->name }}</p>
                <p><strong>Total places:</strong> {{ $plane->max_capacity }}</p>
            </div>
        </div>
    </div>
</div>

@endsection