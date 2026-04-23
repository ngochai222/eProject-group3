@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Add New Movie</h2>
    <a href="{{ route('admin.movies.index') }}" class="text-gray-400 hover:text-white text-sm transition">← Back</a>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data" id="movieForm">
@csrf

<div class="grid grid-cols-3 gap-6">

    {{-- FORM --}}
    <div class="col-span-2 bg-[#11161c] p-6 rounded-2xl space-y-5">

        {{-- Title --}}
        <div>
            <label class="text-sm text-gray-400">Movie Title</label>
            <input type="text" name="title" placeholder="Enter movie name"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                oninput="updatePreview()" required>
        </div>

        {{-- Genre + Duration --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-400">Genre</label>
                <input type="text" name="genre" placeholder="e.g. Action, Horror"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    oninput="updatePreview()">
            </div>
            <div>
                <label class="text-sm text-gray-400">Duration (minutes)</label>
                <input type="number" name="duration" placeholder="120" min="1"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    oninput="updatePreview()">
            </div>
        </div>

        {{-- Cast --}}
        <div>
            <label class="text-sm text-gray-400">Cast</label>
            <input type="text" name="cast" placeholder="e.g. Tom Hanks, Brad Pitt"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
        </div>

        {{-- Release Date + Price --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-400">Release Date</label>
                <input type="date" name="release_date" id="selReleaseDate"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    oninput="updatePreview()">
            </div>
            <div>
                <label class="text-sm text-gray-400">Base Price ($)</label>
                <input type="number" name="base_price" placeholder="10.00" min="0" step="0.5"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
            </div>
        </div>
        </div>

        {{-- Description --}}
        <div>
            <label class="text-sm text-gray-400">Description</label>
            <textarea name="description" rows="4" placeholder="Enter movie description..."
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                oninput="updatePreview()"></textarea>
        </div>

        {{-- Poster --}}
        <div>
            <label class="text-sm text-gray-400">Poster Image</label>
            <input type="file" name="poster" accept="image/*"
                class="w-full mt-2 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-yellow-400 file:text-black file:font-semibold hover:file:bg-yellow-300"
                onchange="previewPoster(event)">
        </div>

        {{-- Trailer --}}
        <div>
            <label class="text-sm text-gray-400">Trailer URL</label>
            <input type="text" name="trailer" placeholder="https://youtube.com/..."
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.movies.index') }}"
               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded text-white transition">Cancel</a>
            <button type="submit"
               class="px-6 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded font-semibold transition">
                Save Movie
            </button>
        </div>
    </div>

    {{-- PREVIEW --}}
    <div class="bg-[#11161c] p-6 rounded-2xl">
        <h3 class="font-semibold text-white mb-4">Preview</h3>

        <div class="bg-black p-4 rounded-xl space-y-3">
            <div id="previewPosterBox" class="w-full h-56 bg-gray-800 rounded overflow-hidden flex items-center justify-center">
                <img id="previewPosterImg" src="" class="w-full h-full object-cover hidden">
                <span id="previewPosterPlaceholder" class="text-gray-600 text-sm">No poster</span>
            </div>

            <h3 id="previewTitle" class="font-semibold text-white">Movie Title</h3>

            <p id="previewMeta" class="text-xs text-gray-400">Genre • Duration • Year</p>

            <p id="previewDesc" class="text-sm text-gray-300">Movie description will appear here...</p>

            <div class="flex gap-2">
                <span class="bg-yellow-400 text-black px-3 py-1 rounded text-xs font-bold">HD</span>
                <span class="bg-gray-700 text-white px-3 py-1 rounded text-xs">Subtitle</span>
            </div>
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

function updatePreview() {
    const title    = document.querySelector('[name=title]').value || 'Movie Title';
    const genre    = document.querySelector('[name=genre]').value || 'Genre';
    const duration = document.querySelector('[name=duration]').value || '—';
    const date     = document.querySelector('[name=release_date]').value;
    const desc     = document.querySelector('[name=description]').value || 'Movie description will appear here...';
    const year     = date ? new Date(date).getFullYear() : 'Year';

    document.getElementById('previewTitle').textContent = title;
    document.getElementById('previewMeta').textContent  = genre + ' • ' + duration + ' min • ' + year;
    document.getElementById('previewDesc').textContent  = desc;
}
</script>

@endsection
