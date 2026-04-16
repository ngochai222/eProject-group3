@extends('layout.master')
@section('content')

<div style="padding:40px; color:white;">
    <h2 style="color:#ff4d2d;"> BOOKING LIST</h2>

    <div style="display:flex; flex-wrap:wrap; gap:20px;">
        @foreach($bookings as $booking)
        <div style="
            background:#1c1c1c;
            padding:20px;
            border-radius:10px;
            width:250px;
        ">
            <h3>{{ $booking->customer_name }}</h3>

            <p> Movie: {{ $booking->showtime->movie->title ?? 'N/A' }}</p>
            <p> Seat: {{ $booking->seat->seat_number ?? 'N/A' }}</p>
            <p> Time: {{ $booking->showtime->start_time ?? 'N/A' }}</p>
            <p> Price: {{ $booking->price }}</p>
        </div>
        @endforeach
    </div>
</div>


@endsection