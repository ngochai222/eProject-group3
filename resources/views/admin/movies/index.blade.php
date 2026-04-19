@extends('admin.layout.layout')

@section('content')

<h2 class="mb-4">🎬 Movies Management</h2>

<a href="{{ route('admin.movies.create') }}" class="btn btn-yellow mb-3">
    + Add Movie
</a>

<div class="card-dark">
    <table class="table table-dark table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Cast</th>
                <th>Duration</th>
                <th>Release Date</th>
                <th>Poster</th>
                <th>Trailer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre ?? '—' }}</td>
                <td>{{ $movie->cast ?? '—' }}</td>
                <td>{{ $movie->duration }} min</td>
                <td>{{ $movie->release_date }}</td>
                <td>
                    @if($movie->poster)
                        <img src="{{ asset('uploads/'.$movie->poster) }}" width="60">
                    @endif
                </td>
                <td>
                    @if($movie->trailer)
                        <a href="{{ asset('uploads/'.$movie->trailer) }}" target="_blank" class="btn btn-sm btn-info">▶ Play</a>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this movie?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
