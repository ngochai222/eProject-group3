<h1>🎬 Manage Movies</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.movies.create') }}">➕ Add Movie</a>

@foreach($movies as $movie)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <h3>{{ $movie->title }}</h3>
        <p>{{ $movie->description }}</p>
        <p>Duration: {{ $movie->duration }} phút</p>

        <a href="{{ route('admin.movies.edit', $movie->id) }}">✏ Edit</a>

        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">🗑 Delete</button>
        </form>
    </div>
@endforeach