@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Managers</h2>
        <p class="text-sm text-gray-500 mt-1">Manage staff accounts and permissions</p>
    </div>
    <a href="{{ route('admin.managers.create') }}"
        class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-5 py-2 rounded-lg transition">
        + Add Manager
    </a>
</div>

<div class="bg-[#11161c] rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Manager</th>
                <th class="px-4 py-3 text-left">Permissions</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($managers as $m)
            @php $perms = is_string($m->permissions) ? json_decode($m->permissions, true) : (array)($m->permissions ?? []); @endphp
            <tr class="border-b border-gray-800/50 hover:bg-white/5 transition">
                <td class="px-5 py-4">
                        <p class="font-semibold text-white">{{ $m->customer_name }}</p>
                        <p class="text-xs text-gray-500">{{ $m->customer_email }}</p>
                </td>
                <td class="px-4 py-4">
                    <div class="flex flex-wrap gap-1">
                        @forelse($perms as $p)
                            <span class="bg-cyan-500/10 text-cyan-400 text-[10px] px-2 py-0.5 rounded-full border border-cyan-500/20">{{ ucfirst($p) }}</span>
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
                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.managers.edit', $m->customer_id) }}" class="text-gray-400 hover:text-yellow-400 transition"><i class="fa fa-pencil"></i></a>
                            <form action="{{ route('admin.managers.destroy', $m->customer_id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-400 transition" onclick="return confirm('Delete this manager?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-5 py-10 text-center text-gray-500">No managers yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
