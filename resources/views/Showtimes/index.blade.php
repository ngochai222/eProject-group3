@extends('layout.master')

@section('content')
<div style="padding:40px; color:white;">
    <h2 style="color:#ff4d2d;"> SHOW TIME</h2>

    <div style="display:flex; flex-wrap:wrap; gap:20px;">
        @foreach($showtimes as $show)
        <div style="
            background:#1c1c1c;
            padding:20px;
            border-radius:10px;
            width:250px;
        ">
            <h3>{{ $show->movie->title ?? 'No Movie' }}</h3>

            <p> Room: {{ $show->room->name ?? 'N/A' }}</p>
            <p> Time: {{ $show->start_time }}</p>

            <a href="/booking" style="
                display:inline-block;
                margin-top:10px;
                padding:8px 12px;
                background:#ff4d2d;
                color:white;
                text-decoration:none;
                border-radius:5px;
            ">
                Book Now
            </a>
        </div>
        @endforeach
    </div>
</div>


@endsection