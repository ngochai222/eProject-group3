<h1>✏ Edit Movie</h1>

<form method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $movie->title }}"><br><br>

    <textarea name="description">{{ $movie->description }}</textarea><br><br>

    <input type="number" name="duration" value="{{ $movie->duration }}"><br><br>

    <button type="submit">Update</button>
</form>