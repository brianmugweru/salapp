@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">My Bookings</div>
            <div class="panel-body">
                @foreach($bookings as $booking)
                    <p>{{ $booking->salon->name }}, {{ $booking->booking }} times booked</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
