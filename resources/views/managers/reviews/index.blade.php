@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Reviews</h2>
        <p class="text-sm text-gray-500 mt-1">Customer feedback management</p>
    </div>
</div>

{{-- STATS --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-[#11161c] rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Reviews</p>
        <h2 class="text-3xl font-black text-white">{{ $totalReviews }}</h2>
    </div>
    <div class="bg-[#11161c] rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Avg Rating</p>
        <h2 class="text-3xl font-black text-yellow-400">{{ $avgRating ? number_format($avgRating, 1) : '—' }} ★</h2>
    </div>
    <div class="bg-[#11161c] rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">5-Star Reviews</p>
        <h2 class="text-3xl font-black text-green-400">{{ $fiveStars }}</h2>
    </div>
</div>

{{-- SEARCH --}}
<div class="relative mb-4 max-w-sm">
    <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
    <input type="text" id="searchInput" placeholder="Search by movie or customer..."
        class="w-full bg-[#11161c] text-white text-sm pl-8 pr-4 py-2 rounded-xl border border-gray-700 focus:border-yellow-400 outline-none">
</div>

{{-- REVIEWS LIST --}}
<div class="space-y-3">
    @forelse($reviews as $r)
    <div class="review-row bg-[#11161c] rounded-2xl p-5 flex gap-4"
         data-search="{{ strtolower($r->movie->title ?? '') }} {{ strtolower($r->user_name) }}">

        {{-- Movie poster --}}
        <div class="w-12 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-gray-800">
            @if($r->movie && $r->movie->poster)
                <img src="{{ asset('uploads/'.$r->movie->poster) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fa fa-film text-gray-600 text-xs"></i>
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-bold text-white">{{ $r->movie->title ?? 'Unknown Movie' }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">by <span class="text-gray-300">{{ $r->user_name }}</span>
                        · {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-yellow-400 font-black text-sm">
                        {{ str_repeat('★', $r->rating) }}<span class="text-gray-700">{{ str_repeat('★', 5-$r->rating) }}</span>
                    </span>
                    <form action="{{ route('admin.reviews.destroy', $r->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-500 hover:text-red-400 transition"
                            onclick="return confirm('Delete this review?')">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @if($r->comment)
                <p class="text-sm text-gray-400 mt-2">{{ $r->comment }}</p>
            @endif
        </div>
    </div>
    @empty
    <div class="bg-[#11161c] rounded-2xl p-10 text-center text-gray-500">No reviews yet.</div>
    @endforelse
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.review-row').forEach(row => {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
});
</script>

@endsection
