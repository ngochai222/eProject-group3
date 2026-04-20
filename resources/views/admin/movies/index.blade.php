@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">🎬 Movies Management</h2>
    <a href="{{ route('admin.movies.create') }}" class="btn btn-yellow">+ Add Movie</a>
</div>

<div class="card-dark">
    <table class="table table-dark table-bordered text-center align-middle w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Duration</th>
                <th>Release Date</th>
                <th>Trailer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>
                    @if($movie->poster)
                        <img src="{{ asset('uploads/'.$movie->poster) }}" width="60" class="rounded">
                    @else
                        <span class="text-gray-500">—</span>
                    @endif
                </td>
                <td class="text-left">{{ $movie->title }}</td>
                <td>{{ $movie->genre ?? '—' }}</td>
                <td>{{ $movie->duration ? $movie->duration.' min' : '—' }}</td>
                <td>{{ $movie->release_date ?? '—' }}</td>
                <td>
                    @if($movie->trailer)
                        <a href="{{ $movie->trailer }}" target="_blank" class="btn btn-sm btn-info">▶ Play</a>
                    @else
                        <span class="text-gray-500">—</span>
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
            @empty
            <tr><td colspan="8" class="text-gray-500 py-4">No movies found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
