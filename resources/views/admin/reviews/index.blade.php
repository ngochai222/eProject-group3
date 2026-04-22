@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Reviews</h2>
    <a href="{{ route('admin.reviews.create') }}" class="bg-yellow-400 text-black font-bold px-4 py-2 rounded hover:bg-yellow-300 transition">
        + Add Review
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
@foreach($reviews as $r)
<div class="bg-[#11161c] p-4 rounded-xl">
    <h5 class="font-bold text-white mb-1">{{ $r->movie->title ?? 'No movie' }}</h5>
    <p class="text-sm text-gray-400 mb-1">{{ $r->user_name }}</p>
    <div class="flex gap-0.5 mb-2">
        @for($i=1;$i<=5;$i++)
            <span class="text-{{ $i <= $r->rating ? 'yellow' : 'gray' }}-400 text-sm">★</span>
        @endfor
    </div>
    <p class="text-sm text-gray-300 mb-3">{{ $r->comment }}</p>
    @if($r->image)
        <img src="{{ asset('uploads/'.$r->image) }}" class="w-full rounded mb-3">
    @endif
    <form action="{{ route('admin.reviews.destroy', $r->id) }}" method="POST">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this review?')">Delete</button>
    </form>
</div>
@endforeach
</div>

@endsection
