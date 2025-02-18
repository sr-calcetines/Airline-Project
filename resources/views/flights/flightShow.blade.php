@extends('layouts.app2')

@section('content')
<div class="body" id="bodyShow">
    <div class="flight-card">
        <div class="card-content">
            <h2 class="card-title">Flight Details</h2>
            <p><strong>Date:</strong> {{ $flights->date }}</p>
            <p><strong>Departure:</strong> {{ $flights->departure }}</p>
            <p><strong>Arrival:</strong> {{ $flights->arrival }}</p>
            <p><strong>Places reserved:</strong> {{ $flights->reserved }}</p>
            <p><strong>Aviable Places:</strong> {{ $flights->plane->max_capacity - $flights->reserved }}</p>
        </div>

        <div class="ticketBook">
            <div class="reservation">
                <img src={{asset ("img/logo_inverted.png")}} alt="Plane" class="plane">
                <div class="bookDiv">
                    @guest
                        <div class="unsignedDiv">
                            <img src="{{asset('img/warning.png') }}" alt="warning-Button" class="warnBtn">
                            <p class="flightWarning notSigned">You need to sign in to book this flight.</p>
                        </div>
                    @else
                        @if (!$flights->aviable || (!$booked && $flights->reserved == $flights->plane->max_capacity))
                        <div class="notAviableDiv">
                            <img src="{{asset('img/warningRed.png') }}" alt="warning-Button" class="warnBtn">
                            <p class="flightWarning notSigned">There are no disponibles places in this flight.</p>
                        </div>
                    @elseif ($booked && !Auth::user()->isAdmin)
                        <div class="bookDiv">
                            <a class="bookBtn" href="{{ route('flightShow', ['id' => $flights->id, 'action' => 'unbook']) }}">
                                <p>Unbook</p>
                            </a>
                        </div>
                    @elseif (!$booked && !Auth::user()->isAdmin)
                        <div class="bookDiv">
                            <a class="bookBtn" href="{{ route('flightShow', ['id' => $flights->id, 'action' => 'book']) }}">
                                <p>Book NOW!</p>
                            </a>
                        </div>
                    @endif
                    @endguest

                </div>
                <div class="barcodeDiv">
                    <img src={{asset ("img/barcode.png")}} alt="Barcode" class="barcode">
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection