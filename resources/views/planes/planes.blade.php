@extends('layouts.app2')

@section('content')
<div class="body">
    
    @if(Auth::check() && Auth::user()->isAdmin)
            <div class="addBtn" id="planeAdd">
                <a href="{{ route('createPlaneForm')}}" class="crudBtn">
                    <img src="{{asset('img/add.png') }}" alt="add-Button" class="add">
                </a>
            </div>
    @endif

    <div class="tablePlane">
        <h2 class="table-title">Planes List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Total places</th>
                    @if(Auth::check() && Auth::user()->isAdmin)
                        <th>Actions</th>
                    @endif
            </thead>
            <tbody>
                @foreach ($planes as $plane)
                    <tr class="row" id="{{$plane->id}}">
                        <td>{{ $plane->id }}</td>
                        <td>{{ $plane->name }}</td>
                        <td>{{ $plane->max_capacity }}</td>
                        @if(Auth::check() && Auth::user()->isAdmin)
                            <td>
                                <a href="{{ route('editPlaneForm', $plane->id) }}" class="crudBtn">
                                    <img src="{{asset('img/edit.png') }}" alt="edit-Button" class="crudBtn">
                                </a>
                                <a href="?action=delete&id={{ $plane->id }}"onclick="return confirm('Are you sure you want to delete this plane? ID: {{ $plane->id }}')">
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
<script src="{{ asset('js/script2.js') }}"></script>
@endsection


    
