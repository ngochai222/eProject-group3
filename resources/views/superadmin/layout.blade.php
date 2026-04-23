<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinebook SuperAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>body { background: #070a0f; color: white; font-family: sans-serif; }</style>
</head>
<body class="min-h-screen flex">

{{-- SIDEBAR --}}
<aside class="w-64 bg-[#0d1117] border-r border-gray-800 flex flex-col min-h-screen fixed top-0 left-0 z-40">
    <div class="p-6 border-b border-gray-800">
        <h1 class="text-red-500 font-black text-xl">CINEBOOK</h1>
        <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest mt-1">Super Admin</p>
    </div>

    <nav class="flex-1 px-4 py-4 space-y-1 text-sm">
        <a href="/superadmin/dashboard" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('superadmin/dashboard') ? 'bg-yellow-400/10 text-yellow-400 border border-yellow-400/20' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-gauge w-4"></i> Dashboard
        </a>
        <a href="/superadmin/managers" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('superadmin/managers*') ? 'bg-yellow-400/10 text-yellow-400 border border-yellow-400/20' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-users-gear w-4"></i> Managers
        </a>
        <a href="/superadmin/tasks" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('superadmin/tasks*') ? 'bg-yellow-400/10 text-yellow-400 border border-yellow-400/20' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-list-check w-4"></i> Tasks & Schedule
        </a>
        <a href="/superadmin/profile" class="flex items-center gap-2 px-4 py-2 rounded {{ request()->is('superadmin/profile*') ? 'bg-yellow-400/10 text-yellow-400 border border-yellow-400/20' : 'text-gray-400 hover:bg-gray-800' }}">
            <i class="fa fa-user-shield w-4"></i> My Profile
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
    @yield('content')
</main>

</body>
</html>
