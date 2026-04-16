<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CineBook Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f1117;
            color: white;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #111827;
            position: fixed;
            padding: 20px;
        }

        .sidebar h4 {
            color: #facc15;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            color: #ccc;
            padding: 10px;
            margin-top: 10px;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1f2937;
            color: #fff;
        }

        .content {
            margin-left: 260px;
            padding: 25px;
        }

        .card-dark {
            background: #1f2937;
            border-radius: 15px;
            padding: 15px;
        }

        .btn-yellow {
            background: #facc15;
            border: none;
            color: black;
            font-weight: bold;
        }

        table img {
            border-radius: 6px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>🎬 CINEBOOK</h4>

    <a href="/admin/dashboard"
       class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="/admin/movies"
       class="{{ request()->is('admin/movies*') ? 'active' : '' }}">
        <i class="fa fa-film"></i> Movies
    </a>

    <a href="/admin/showtimes"
       class="{{ request()->is('admin/showtimes*') ? 'active' : '' }}">
        <i class="fa fa-clock"></i> Showtimes
    </a>

    <a href="/admin/reviews"
       class="{{ request()->is('admin/reviews*') ? 'active' : '' }}">
        <i class="fa fa-star"></i> Reviews
    </a>
</div>

<!-- CONTENT -->
<div class="content">

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- NỘI DUNG --}}
    @yield('content')

</div>

</body>
</html>