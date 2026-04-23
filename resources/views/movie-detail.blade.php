<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie['title'] ?? 'Movie Detail' }} - Cinebook</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">

@include('components.header')

<div class="pt-20 pb-16 px-6 md:px-10 max-w-5xl mx-auto">

    {{-- Banner --}}
    <div class="flex flex-col md:flex-row gap-8 mb-10">
        <img src="{{ $movie['image'] }}" class="w-48 rounded-xl object-cover flex-shrink-0" alt="{{ $movie['title'] }}">

        <div class="flex-1">
            <h2 class="text-3xl font-black uppercase mb-2">{{ $movie['title'] }}</h2>

            <div class="flex flex-wrap gap-2 text-sm text-gray-400 mb-4">
                @if(!empty($movie['genre']))
                    <span> {{ $movie['genre'] }}</span>
                @endif
                @if(!empty($movie['duration']))
                    <span> {{ $movie['duration'] }}</span>
                @endif
                @if(!empty($movie['release_date']))
                    <span> {{ $movie['release_date'] }}</span>
                @endif
            </div>

            <div class="flex gap-3 flex-wrap">
                
                <a href="{{ isset($movie['id']) ? route('showtime.detail', $movie['id']) : route('showtime') }}"
                   class="bg-gray-700 hover:bg-gray-600 px-5 py-2 rounded-full font-bold text-sm transition">
                     Buy Tickets
                </a>
                @if(!empty($movie['trailer']))
                    <a href="{{ $movie['trailer'] }}" target="_blank"
                       class="bg-[#E50914] hover:bg-red-700 px-5 py-2 rounded-full font-bold text-sm transition flex items-center gap-2">
                        <span class="material-icons text-base">play_circle</span> Watch Trailer
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if(!empty($movie['description']))
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-3">Description</h3>
        <p class="text-gray-400 leading-relaxed">{{ $movie['description'] }}</p>
    </div>
    @endif

    {{-- Cast --}}
    @if(!empty($movie['cast']))
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-3">Cast</h3>
        <p class="text-gray-400">{{ $movie['cast'] }}</p>
    </div>
    @endif

    {{-- Details --}}
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-3">Details</h3>
        <ul class="text-gray-400 space-y-1 text-sm">
            @if(!empty($movie['release_date']))
                <li><strong class="text-white">Release:</strong> {{ $movie['release_date'] }}</li>
            @endif
            @if(!empty($movie['genre']))
                <li><strong class="text-white">Genre:</strong> {{ $movie['genre'] }}</li>
            @endif
            @if(!empty($movie['duration']))
                <li><strong class="text-white">Duration:</strong> {{ $movie['duration'] }}</li>
            @endif
        </ul>
    </div>

    {{-- Reviews & Feedback --}}
    <div class="mt-10">
        <div class="flex items-center gap-3 mb-5">
            <h3 class="text-xl font-bold">Reviews</h3>
            @if(isset($avgRating) && $avgRating)
                <span class="text-yellow-400 font-black">★ {{ number_format($avgRating, 1) }}</span>
                <span class="text-gray-500 text-sm">({{ $reviews->count() }})</span>
            @endif
        </div>

        {{-- Write Review --}}
        @auth('customer')
            @if(isset($hasBooked) && $hasBooked && !(isset($hasReviewed) && $hasReviewed))
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 mb-6">
                <h4 class="font-bold text-white mb-4">Write a Review</h4>
                @if($errors->has('feedback'))
                    <p class="text-red-400 text-sm mb-3">{{ $errors->first('feedback') }}</p>
                @endif
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                    <div class="mb-3">
                        <label class="text-xs text-gray-400 block mb-2">Rating</label>
                        <div class="flex gap-2" id="starRating">
                            @for($i=1;$i<=5;$i++)
                            <button type="button" onclick="setRating({{ $i }})" data-star="{{ $i }}"
                                class="text-3xl text-gray-600 hover:text-yellow-400 transition star-btn">★</button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" required>
                    </div>
                    <div class="mb-4">
                        <label class="text-xs text-gray-400 block mb-2">Comment</label>
                        <textarea name="comment" rows="3" placeholder="Share your thoughts..."
                            class="w-full px-4 py-2 bg-black/50 rounded-xl text-white border border-white/10 focus:border-[#E50914] outline-none text-sm"></textarea>
                    </div>
                    <button type="submit"
                        class="bg-[#E50914] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-full transition text-sm">
                        Submit Review
                    </button>
                </form>
            </div>
            @elseif(isset($hasReviewed) && $hasReviewed)
            <div class="bg-green-500/10 border border-green-500/20 rounded-xl p-4 mb-6 text-sm text-green-400">
                You have already reviewed this movie.
            </div>
            @elseif(!isset($hasBooked) || !$hasBooked)
            <div class="bg-white/5 border border-white/10 rounded-xl p-4 mb-6 text-sm text-gray-500">
                Purchase a ticket to leave a review.
            </div>
            @endif
        @endauth

        {{-- Reviews List --}}
        @if(isset($reviews) && $reviews->count() > 0)
        <div class="space-y-4">
            @foreach($reviews as $r)
            <div class="bg-white/5 rounded-2xl p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-white text-sm">{{ $r->user_name }}</p>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}</p>
                    </div>
                    <span class="text-yellow-400 font-black">{{ str_repeat('★', $r->rating) }}<span class="text-gray-700">{{ str_repeat('★', 5-$r->rating) }}</span></span>
                </div>
                @if($r->comment)
                    <p class="text-sm text-gray-300">{{ $r->comment }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-600 text-sm">No reviews yet.</p>
        @endif
    </div>

</div>

<script>
function setRating(val) {
    document.getElementById('ratingInput').value = val;
    document.querySelectorAll('.star-btn').forEach((btn, i) => {
        btn.style.color = i < val ? '#facc15' : '#4b5563';
    });
}
</script>

</body>
</html>
