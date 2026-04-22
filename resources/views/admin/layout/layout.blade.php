<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinebook Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0f14; color: white; font-family: 'Poppins', sans-serif; }
        .card-dark { background: #11161c; border-radius: 12px; padding: 16px; }
        .btn-yellow { background: #facc15; border: none; color: black; font-weight: bold; }
        .table-dark { background: transparent; }
        .table-dark td, .table-dark th { color: #ccc; border-color: #1f2937; }
    </style>
</head>
<body class="min-h-screen flex">

{{-- SIDEBAR --}}
<aside class="w-64 bg-[#0f141b] border-r border-gray-800 flex flex-col min-h-screen fixed top-0 left-0 z-40">
    <div class="p-6">
        <h1 class="text-red-500 font-bold text-xl">CINEBOOK ADMIN</h1>
    </div>

    <nav class="flex-1 px-4 space-y-1 text-sm">
        <a href="/admin/dashboard" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-home w-4"></i> Dashboard
        </a>
        <a href="/admin/movies" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/movies*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-film w-4"></i> Movies
        </a>
        <a href="/admin/showtimes" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/showtimes*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-clock w-4"></i> Showtimes
        </a>
        <a href="/admin/reviews" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/reviews*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-star w-4"></i> Reviews
        </a>
        <a href="/admin/cinemas" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/cinemas*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-building w-4"></i> Cinemas
        </a>
        <a href="/admin/customers" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/customers*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-users w-4"></i> Customer Accounts
        </a>
        <a href="/admin/tickets" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/tickets*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-ticket w-4"></i> Tickets
        </a>
        <a href="/admin/pricing" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/pricing*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-tag w-4"></i> Pricing
        </a>
        <a href="/admin/seats" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/seats*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-th w-4"></i> Seats
        </a>
        <a href="/admin/promotions" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('admin/promotions*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-percent w-4"></i> Promotions
        </a>
    </nav>

    <div class="p-4 border-t border-gray-800">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full text-left text-sm text-gray-400 hover:text-red-400 transition flex items-center gap-2">
                <i class="fa fa-sign-out-alt w-4"></i> Log Out
            </button>
        </form>
    </div>
</aside>

{{-- CONTENT --}}
<main class="ml-64 flex-1 p-8 min-h-screen">

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    @yield('content')

</main>

</body>
</html>
