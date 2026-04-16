@extends('admin.layout.layout')

@section('content')

<h2 class="mb-4">✏️ Edit Movie</h2>

<form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ $movie->title }}" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $movie->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Duration</label>
        <input type="number" name="duration" class="form-control" value="{{ $movie->duration }}">
    </div>

    <div class="mb-3">
        <label>Release Date</label>
        <input type="date" name="release_date" class="form-control" value="{{ $movie->release_date }}">
    </div>

    <div class="mb-3">
        <label>Poster</label>
        <input type="file" name="poster" class="form-control" onchange="previewImage(event)">
    </div>

    <div class="mb-3">
        @if($movie->poster)
            <img src="{{ asset('uploads/'.$movie->poster) }}" width="120" id="preview">
        @else
            <img id="preview" width="120" style="display:none;">
        @endif
    </div>

    <button class="btn btn-warning">Update</button>
</form>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>

@endsection