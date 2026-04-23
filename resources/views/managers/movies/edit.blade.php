@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Edit Movie</h2>
    <a href="{{ route('admin.movies.index') }}" class="text-gray-400 hover:text-white text-sm transition">← Back</a>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-3 gap-6">

        {{-- FORM --}}
        <div class="col-span-2 bg-[#11161c] p-6 rounded-2xl space-y-5">

            <div>
                <label class="text-sm text-gray-400">Movie Title</label>
                <input type="text" name="title" value="{{ $movie->title }}"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-400">Genre</label>
                    <input type="text" name="genre" value="{{ $movie->genre }}"
                        class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
                </div>
                <div>
                    <label class="text-sm text-gray-400">Duration (minutes)</label>
                    <input type="number" name="duration" value="{{ $movie->duration }}" min="1"
                        class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-400">Cast</label>
                <input type="text" name="cast" value="{{ $movie->cast }}"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-400">Release Date</label>
                    <input type="date" name="release_date" value="{{ $movie->release_date }}"
                        class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
                </div>
                <div>
                    <label class="text-sm text-gray-400">Base Price ($)</label>
                    <input type="number" name="base_price" value="{{ $movie->base_price ?? 10 }}" min="0" step="0.5"
                        class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-400">Description</label>
                <textarea name="description" rows="4"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">{{ $movie->description }}</textarea>
            </div>

            <div>
                <label class="text-sm text-gray-400">Poster (leave empty to keep current)</label>
                <input type="file" name="poster" accept="image/*"
                    class="w-full mt-2 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-yellow-400 file:text-black file:font-semibold hover:file:bg-yellow-300"
                    onchange="previewPoster(event)">
            </div>

            <div>
                <label class="text-sm text-gray-400">Trailer URL</label>
                <input type="text" name="trailer" value="{{ $movie->trailer }}" placeholder="https://youtube.com/..."
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.movies.index') }}"
                   class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded text-white transition">Cancel</a>
                <button type="submit"
                   class="px-6 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded font-semibold transition">
                    Update Movie
                </button>
            </div>
        </div>

        {{-- PREVIEW --}}
        <div class="bg-[#11161c] p-6 rounded-2xl">
            <h3 class="font-semibold text-white mb-4">Preview</h3>
            <div class="bg-black p-4 rounded-xl space-y-3">
                <div class="w-full h-56 rounded overflow-hidden bg-gray-800 flex items-center justify-center">
                    @if($movie->poster)
                        <img id="previewPosterImg" src="{{ asset('uploads/'.$movie->poster) }}" class="w-full h-full object-cover">
                    @else
                        <img id="previewPosterImg" src="" class="w-full h-full object-cover hidden">
                    @endif
                    <span id="previewPosterPlaceholder" class="text-gray-600 text-sm {{ $movie->poster ? 'hidden' : '' }}">No poster</span>
                </div>
                <h3 class="font-semibold text-white">{{ $movie->title }}</h3>
                @if($movie->trailer)
                    <a href="{{ $movie->trailer }}" target="_blank"
                       class="inline-flex items-center gap-1 text-xs text-red-400 hover:underline">
                        <i class="fa fa-play-circle"></i> Watch Trailer
                    </a>
                @endif
            </div>
        </div>

    </div>
</form>

<script>
function previewPoster(event) {
    const file = event.target.files[0];
    if (!file) return;
    const img = document.getElementById('previewPosterImg');
    img.src = URL.createObjectURL(file);
    img.classList.remove('hidden');
    document.getElementById('previewPosterPlaceholder').classList.add('hidden');
}
</script>

@endsection
