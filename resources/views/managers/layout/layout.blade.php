<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinebook Manager</title>
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
        <h1 class="text-red-500 font-bold text-xl">CINEBOOK MANAGER</h1>
    </div>

    <nav class="flex-1 px-4 space-y-1 text-sm" style="text-decoration:none">
        <style>aside nav a { text-decoration: none !important; }</style>
        <a href="/managers/dashboard" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-home w-4"></i> Dashboard
        </a>
        @if(session('admin_logged_in') || in_array("movies", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/movies" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/movies*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-film w-4"></i> Movies
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("showtimes", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/showtimes" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/showtimes*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-clock w-4"></i> Showtimes
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("reviews", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/reviews" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/reviews*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-star w-4"></i> Reviews
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("cinemas", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/cinemas" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/cinemas*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-building w-4"></i> Cinemas
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("customers", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/customers" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/customers*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-users w-4"></i> Customer Accounts
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("tickets", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/tickets" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/tickets*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-ticket w-4"></i> Tickets
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("pricing", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/pricing" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/pricing*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-tag w-4"></i> Pricing
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("seats", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/seats" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/seats*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-th w-4"></i> Seats
        </a>
        @endif
        @if(session('admin_logged_in') || in_array("promotions", (array)(session("manager_permissions") ?? [])))
        <a href="/managers/promotions" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/promotions*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-percent w-4"></i> Promotions
        </a>
        @endif
        @if(session('admin_logged_in'))
        <a href="/managers/managers" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('managers/managers*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-user-shield w-4"></i> Managers
        </a>
        @endif
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
        <div id="toast-success" class="fixed top-6 left-1/2 -translate-x-1/2 z-[9999] bg-green-500/90 backdrop-blur text-white px-6 py-3 rounded-xl shadow-xl flex items-center gap-3 text-sm font-semibold">
            <i class="fa fa-check-circle text-base"></i>
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const t = document.getElementById('toast-success');
                if (t) { t.style.transition = 'opacity 0.5s'; t.style.opacity = '0'; setTimeout(() => t.remove(), 500); }
            }, 3000);
        </script>
    @endif
    @if(session('error'))
        <div id="toast-error" class="fixed top-6 left-1/2 -translate-x-1/2 z-[9999] bg-red-500/90 backdrop-blur text-white px-6 py-3 rounded-xl shadow-xl flex items-center gap-3 text-sm font-semibold">
            <i class="fa fa-exclamation-circle text-base"></i>
            {{ session('error') }}
        </div>
        <script>
            setTimeout(() => {
                const t = document.getElementById('toast-error');
                if (t) { t.style.transition = 'opacity 0.5s'; t.style.opacity = '0'; setTimeout(() => t.remove(), 500); }
            }, 3000);
        </script>
    @endif

    @yield('content')

</main>

</body>
</html>
