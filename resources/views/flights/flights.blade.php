@extends('layouts.app2')

@section('content')
<div class="body">
    
    @if(Auth::check() && Auth::user()->isAdmin)
            <div class="addBtn" id="flightAdd">
                <a href="{{ route('createFlightForm')}}" class="crudBtn">
                    <img src="{{asset('img/add.png') }}" alt="add-Button" class="add">
                </a>
            </div>
    @endif

    <div class="tableFlight">
        <h2 class="table-title">New Flights List</h2>
        <table class="table">
            <thead>
                <tr>
                    @if(Auth::check() && Auth::user()->isAdmin)
                        <th>Id</th>
                        <th>Plane ID</th>
                    @endif
                    <th>Date</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Places reserved</th>
                    <th>Availability</th>
                    @if(Auth::check() && Auth::user()->isAdmin)
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr class="row" id="{{$flight->id}}">
                        @if(Auth::check() && Auth::user()->isAdmin)
                            <td>{{ $flight->id }}</td>
                            <td>{{ $flight->plane_id }}</td>
                        @endif
                        <td>{{ $flight->date }}</td>
                        <td>{{ $flight->departure }}</td>
                        <td>{{ $flight->arrival }}</td>
                        <td>{{ $flight->reserved }}</td>
                        <td>
                            @if ($flight->reserved && ($flight->reserved < $flight->plane->max_capacity))
                                <span class="active">Available</span>
                            @else
                                <span class="inactive">Not Available</span>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->isAdmin)
                            <td>
                                <a href="{{ route('editFlightForm', $flight->id) }}" class="crudBtn">
                                    <img src="{{asset('img/edit.png') }}" alt="edit-Button" class="crudBtn">
                                </a>
                                <a href="?action=delete&id={{ $flight->id }}">
                                    <img src="{{ asset('img/delete.png') }}" alt="delete-Button" class="crudBtn">
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection