@extends('admin.layout.layout')

@section('content')

<h2>⭐ Viết Review Phim</h2>

<form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Phim</label>
<select name="movie_id" class="form-control mb-3">
@foreach($movies as $m)
<option value="{{ $m->id }}">{{ $m->title }}</option>
@endforeach
</select>

<label>Tên bạn</label>
<input type="text" name="user_name" class="form-control mb-3">

<label>Đánh giá</label>

<div id="starBox" class="mb-3">
    <span class="star" data-value="1">★</span>
    <span class="star" data-value="2">★</span>
    <span class="star" data-value="3">★</span>
    <span class="star" data-value="4">★</span>
    <span class="star" data-value="5">★</span>
</div>

<input type="hidden" name="rating" id="ratingInput">

<label>Nhận xét</label>
<textarea name="comment" class="form-control mb-3"></textarea>

<label>Ảnh</label>
<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-warning">Gửi Review</button>

</form>

<style>
.star {
    font-size: 30px;
    color: gray;
    cursor: pointer;
}
.star.active {
    color: gold;
}
</style>

<script>
let stars = document.querySelectorAll('.star');
let ratingInput = document.getElementById('ratingInput');

stars.forEach(star => {
    star.addEventListener('click', function() {
        let value = this.getAttribute('data-value');
        ratingInput.value = value;

        stars.forEach(s => s.classList.remove('active'));

        for (let i = 0; i < value; i++) {
            stars[i].classList.add('active');
        }
    });
});
</script>

@endsection