@extends('admin.layout.layout')

@section('content')

<h2>Edit Showtime</h2>

<form action="{{ route('admin.showtimes.update', $showtime->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Movie</label>
    <select name="movie_id" class="form-control mb-2">
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}"
                {{ $movie->id == $showtime->movie_id ? 'selected' : '' }}>
                {{ $movie->title }}
            </option>
        @endforeach
    </select>

    <label>Start Time</label>
    <input type="datetime-local" name="start_time"
        value="{{ date('Y-m-d\TH:i', strtotime($showtime->start_time)) }}"
        class="form-control mb-2">

    <label>End Time</label>
    <input type="datetime-local" name="end_time"
        value="{{ date('Y-m-d\TH:i', strtotime($showtime->end_time)) }}"
        class="form-control mb-2">

    <button class="btn btn-warning">Update</button>
</form>

@endsection