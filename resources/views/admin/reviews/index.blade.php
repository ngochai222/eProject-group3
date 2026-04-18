@extends('admin.layout.layout')

@section('content')

<h2>⭐ Review Phim</h2>

<a href="{{ route('admin.reviews.create') }}" class="btn btn-warning mb-3">
    + Viết review
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">

@foreach($reviews as $r)

<div class="col-md-4 mb-3">
    <div class="card-dark p-3">

        <h5>{{ $r->movie->title ?? 'No movie' }}</h5>

        <p><strong>{{ $r->user_name }}</strong></p>

        <p>
            @for($i=1;$i<=5;$i++)
                @if($i <= $r->rating)
                    ⭐
                @else
                    ☆
                @endif
            @endfor
        </p>

        <p>{{ $r->comment }}</p>

        @if($r->image)
            <img src="{{ asset('uploads/'.$r->image) }}" width="100%">
        @endif

        <form action="{{ route('admin.reviews.destroy', $r->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm mt-2">Xóa</button>
        </form>

    </div>
</div>

@endforeach

</div>

@endsection