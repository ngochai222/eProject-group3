@extends('superadmin.layout')

@section('content')

<div class="mb-8">
    <h2 class="text-3xl font-black text-white">Welcome, Super Admin</h2>
    <p class="text-gray-500 mt-1">Manage your team and system overview</p>
</div>

{{-- STATS --}}
<div class="grid grid-cols-4 gap-4 mb-8">
    <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Total Managers</p>
        <h2 class="text-3xl font-black text-yellow-400">{{ $totalManagers }}</h2>
    </div>
    <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Active Managers</p>
        <h2 class="text-3xl font-black text-green-400">{{ $activeManagers }}</h2>
    </div>
    <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Total Movies</p>
        <h2 class="text-3xl font-black text-cyan-400">{{ $totalMovies }}</h2>
    </div>
    <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Total Bookings</p>
        <h2 class="text-3xl font-black text-white">{{ $totalBookings }}</h2>
    </div>
</div>

{{-- MANAGERS TABLE --}}
<div class="bg-[#0d1117] border border-gray-800 rounded-2xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-800">
        <h3 class="font-bold text-white">Manager Accounts</h3>
        <a href="/superadmin/managers/create"
            class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-4 py-1.5 rounded-lg text-sm transition">
            + Add Manager
        </a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-600 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Manager</th>
                <th class="px-4 py-3 text-left">Permissions</th>
                <th class="px-4 py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($managers as $m)
            @php $perms = is_string($m->permissions) ? json_decode($m->permissions, true) : (array)($m->permissions ?? []); @endphp
            <tr class="border-b border-gray-800/50 hover:bg-white/3 transition">
                <td class="px-5 py-4">
                    <p class="font-semibold text-white">{{ $m->customer_name }}</p>
                    <p class="text-xs text-gray-500">{{ $m->customer_email }}</p>
                </td>
                <td class="px-4 py-4">
                    <div class="flex flex-wrap gap-1">
                        @forelse($perms as $p)
                            <span class="bg-yellow-400/10 text-yellow-400 text-[10px] px-2 py-0.5 rounded-full border border-yellow-400/20">{{ ucfirst($p) }}</span>
                        @empty
                            <span class="text-gray-600 text-xs">No permissions</span>
                        @endforelse
                    </div>
                </td>
                <td class="px-4 py-4 text-center">
                    @if($m->is_active)
                        <span class="inline-flex items-center gap-1 text-xs text-green-400"><span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Active</span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs text-gray-500"><span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Inactive</span>
                    @endif
                </td>
            </tr>
            </tr>
            @empty
            <tr><td colspan="4" class="px-5 py-10 text-center text-gray-600">No managers yet. <a href="/superadmin/managers/create" class="text-yellow-400 hover:underline">Add one</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
