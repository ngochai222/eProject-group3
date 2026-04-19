@extends('admin.layout.layout')

@section('content')

<h2 class="mb-4">🎬 LỊCH CHIẾU PHIM</h2>

<a href="{{ route('admin.showtimes.create') }}" class="btn btn-warning mb-4">
    + Thêm lịch chiếu
</a>

<div class="card-dark p-4">

    @if($showtimes->count() == 0)
        <p>❌ Chưa có lịch chiếu nào</p>
    @endif

    @foreach($showtimes->groupBy(function($s){
        return date('d/m/Y', strtotime($s->start_time));
    }) as $date => $list)

        <h5 class="mt-3">📅 {{ $date }}</h5>

        <div class="d-flex flex-wrap gap-2 mb-3">

            @foreach($list as $s)

                <div class="p-2" style="background:#1f2937; border-radius:10px;">
                    
                    <strong>{{ $s->movie->title ?? 'No movie' }}</strong>
                    <br>

                    <span class="badge bg-warning text-dark">
                        {{ date('H:i', strtotime($s->start_time)) }}
                    </span>

                    <div class="mt-2">

                        <a href="{{ route('admin.showtimes.edit', $s->id) }}"
                           class="btn btn-sm btn-primary">
                            Sửa
                        </a>

                        <form action="{{ route('admin.showtimes.destroy', $s->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa lịch này?')">
                                Xóa
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @endforeach

</div>

@endsection