@extends('admin.layout.layout')

@section('content')

<h2 class="mb-4">➕ Add Movie</h2>

<form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Genre</label>
        <input type="text" name="genre" class="form-control" placeholder="e.g. Action, Horror">
    </div>

    <div class="mb-3">
        <label>Cast</label>
        <input type="text" name="cast" class="form-control" placeholder="e.g. Tom Hanks, Brad Pitt">
    </div>

    <div class="mb-3">
        <label>Duration (minutes)</label>
        <input type="number" name="duration" class="form-control">
    </div>

    <div class="mb-3">
        <label>Release Date</label>
        <input type="date" name="release_date" class="form-control">
    </div>

    <div class="mb-3">
        <label>Poster</label>
        <input type="file" name="poster" class="form-control" onchange="previewImage(event)">
        <img id="preview" width="120" style="display:none; margin-top:8px;">
    </div>

    <div class="mb-3">
        <label>Trailer</label>
        <input type="file" name="trailer" class="form-control" accept="video/*">
    </div>

    <button class="btn btn-warning">Save</button>
</form>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>

@endsection
