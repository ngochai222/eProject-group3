@extends('admin.layout.layout')

@section('content')

<h2 class="mb-4">🎬 Tạo lịch chiếu (CGV Style)</h2>

<form action="{{ route('admin.showtimes.store') }}" method="POST" id="showtimeForm">
@csrf

<!-- CHỌN PHIM -->
<div class="mb-3">
    <label>Chọn phim</label>
    <select name="movie_id" class="form-control">
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
        @endforeach
    </select>
</div>

<!-- CHỌN NGÀY -->
<label>Chọn ngày</label>
<div class="d-flex gap-2 mb-3 flex-wrap">
    @for($i = 0; $i < 5; $i++)
        @php $date = date('Y-m-d', strtotime("+$i days")); @endphp

        <button type="button"
            class="btn btn-outline-light date-btn"
            data-date="{{ $date }}">
            {{ date('d/m', strtotime($date)) }}
        </button>
    @endfor
</div>

<input type="hidden" name="date" id="dateInput">

<!-- CHỌN GIỜ -->
<label>Chọn giờ chiếu</label>
<div class="d-flex gap-2 flex-wrap mb-3">
    @foreach(['09:00','11:30','14:00','16:30','19:00','21:30'] as $time)
        <button type="button"
            class="btn btn-outline-warning time-btn"
            data-time="{{ $time }}">
            {{ $time }}
        </button>
    @endforeach
</div>

<input type="hidden" name="time" id="timeInput">

<button class="btn btn-warning">💾 Lưu lịch chiếu</button>

</form>

<script>
// chọn ngày
document.querySelectorAll('.date-btn').forEach(btn => {
    btn.onclick = function() {
        document.getElementById('dateInput').value = this.dataset.date;

        document.querySelectorAll('.date-btn').forEach(b => b.classList.remove('btn-light'));
        this.classList.add('btn-light');
    }
});

// chọn giờ
document.querySelectorAll('.time-btn').forEach(btn => {
    btn.onclick = function() {
        document.getElementById('timeInput').value = this.dataset.time;

        document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('btn-warning'));
        this.classList.add('btn-warning');
    }
});

// 🚨 CHECK TRƯỚC KHI SUBMIT
document.getElementById('showtimeForm').onsubmit = function(e) {
    let date = document.getElementById('dateInput').value;
    let time = document.getElementById('timeInput').value;

    if (!date || !time) {
        alert('⚠️ Vui lòng chọn ngày và giờ!');
        e.preventDefault();
    }
};
</script>

@endsection