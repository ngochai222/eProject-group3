<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | CineBook</title>

    {{-- Liên kết CSS Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        div { border: 1px solid red;}
    </style>

    @yield('custom-styles')
</head>
<body>
    {{-- Nhúng nội dung file Header vào trong Master --}}
    @include('layouts.admin.header')

    {{-- Nhúng nội dung file Sidear vào trong Master --}}
    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('layouts.admin.sidebar')
            </div>
            <div class="col-9">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Nhúng nội dung file footer vào trong Master --}}
    @include('layouts.admin.footer')

    {{-- Liên kết JS Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    {{-- Liên kết JQUERY --}}
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

    @yield('custom-scripts')
</body>
</html>