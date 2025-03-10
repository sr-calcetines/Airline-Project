@extends('layouts.app2')

@section('content')
<div class="body">
    
    @if(Auth::check() && Auth::user()->isAdmin)
            <div class="addBtn" id="pastFlightAdd">
                <a href="{{ route('createFlightForm')}}" class="crudBtn">
                    <img src="{{asset('img/add.png') }}" alt="add-Button" class="add">
                </a>
            </div>
    @endif

    <div class="tableFlight">
        <h2 class="table-title">Past Flights List</h2>
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
                    <th>Total Places</th>
                    <th>Places Reserved</th>
                    <th>Disponible Places</th>
                    <th>Availability</th>
                    @if(Auth::check() && Auth::user()->isAdmin)
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($pastFlights as $pastFlight)
                    <tr class="row" id="{{$pastFlight->id}}">
                        @if(Auth::check() && Auth::user()->isAdmin)
                            <td>{{ $pastFlight->id }}</td>
                            <td>{{ $pastFlight->plane_id }}</td>
                        @endif
                        <td>{{ $pastFlight->date }}</td>
                        <td>{{ $pastFlight->departure }}</td>
                        <td>{{ $pastFlight->arrival }}</td>
                        <td>{{ $pastFlight->plane->max_capacity }}</td>
                        <td>{{ $pastFlight->reserved }}</td>
                        <td>{{ $pastFlight->plane->max_capacity - $pastFlight->reserved }}</td>
                        <td>
                            @if ($pastFlight->plane && ($pastFlight->reserved < $pastFlight->plane->max_capacity))
                                <span class="active">Available</span>
                            @else
                                <span class="inactive">Not Available</span>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->isAdmin)
                            <td>
                                <a href="#" class="crudBtn" data-flight-id="{{ $pastFlight->id }}"onclick="event.stopPropagation(); openUserReservations({{ $pastFlight->id }});">
                                    <img src="{{ asset('img/user.png') }}" alt="user-Button" class="crudBtn">
                                </a>
                                <a href="{{ route('editFlightForm', $pastFlight->id) }}" class="crudBtn">
                                    <img src="{{asset('img/edit.png') }}" alt="edit-Button" class="crudBtn">
                                </a>
                                <a href="?action=delete&id={{ $pastFlight->id }}"onclick="return confirm('Are you sure you want to delete this flight? ID: {{ $pastFlight->id }}')">
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

<div id="reservationModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeReservationModal()">&times;</span>
        <h2>Reserved Users</h2>
        <table id="reservationTable" class="table">
            <thead>
                <tr>
                    <th>User's ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/script3.js') }}"></script>
@endsection