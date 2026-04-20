@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Add Review</h2>
    <a href="{{ route('admin.reviews.index') }}" class="text-gray-400 hover:text-white text-sm transition">← Back</a>
</div>

<div class="bg-[#11161c] p-6 rounded-xl max-w-xl">
<form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="mb-4">
    <label class="text-sm text-gray-400">Movie</label>
    <select name="movie_id" class="form-control mt-1">
        @foreach($movies as $m)
            <option value="{{ $m->id }}">{{ $m->title }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="text-sm text-gray-400">Your Name</label>
    <input type="text" name="user_name" class="form-control mt-1">
</div>

<div class="mb-4">
    <label class="text-sm text-gray-400 block mb-2">Rating</label>
    <div id="starBox" class="flex gap-1">
        @for($i=1;$i<=5;$i++)
            <span class="star text-3xl text-gray-600 cursor-pointer" data-value="{{ $i }}">★</span>
        @endfor
    </div>
    <input type="hidden" name="rating" id="ratingInput">
</div>

<div class="mb-4">
    <label class="text-sm text-gray-400">Comment</label>
    <textarea name="comment" class="form-control mt-1" rows="4"></textarea>
</div>

<div class="mb-4">
    <label class="text-sm text-gray-400">Image</label>
    <input type="file" name="image" class="form-control mt-1">
</div>

<button class="btn btn-warning">Submit Review</button>
</form>
</div>

<script>
const stars = document.querySelectorAll('.star');
stars.forEach(star => {
    star.addEventListener('click', function() {
        const value = this.getAttribute('data-value');
        document.getElementById('ratingInput').value = value;
        stars.forEach((s, i) => {
            s.style.color = i < value ? 'gold' : '#4b5563';
        });
    });
    star.addEventListener('mouseover', function() {
        const value = this.getAttribute('data-value');
        stars.forEach((s, i) => {
            s.style.color = i < value ? 'gold' : '#4b5563';
        });
    });
    star.addEventListener('mouseout', function() {
        const val = document.getElementById('ratingInput').value || 0;
        stars.forEach((s, i) => {
            s.style.color = i < val ? 'gold' : '#4b5563';
        });
    });
});
</script>

@endsection
