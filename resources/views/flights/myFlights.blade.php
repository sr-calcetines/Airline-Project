@extends('layouts.app2')

@section('content')
<div class="body">
    <div class="tableFlight">
            <h2 class="table-title">{{Auth::user()->name}}'s in progress Reservations</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userFlights as $flight)
                        <tr class="row" id="{{$flight->id}}">
                            <td>{{ $flight->date }}</td>
                            <td>{{ $flight->departure }}</td>
                            <td>{{ $flight->arrival }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

    <div class="tableFlight">
            <h2 class="table-title">{{Auth::user()->name}}'s record Reservations</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userPastFlights as $flight)
                        <tr class="row" id="{{$flight->id}}">
                            <td>{{ $flight->date }}</td>
                            <td>{{ $flight->departure }}</td>
                            <td>{{ $flight->arrival }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    
</div>

@endsection