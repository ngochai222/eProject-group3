@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Promotions</h2>
        <p class="text-sm text-gray-500 mt-1">Manage discount codes</p>
    </div>
    <button onclick="document.getElementById('addForm').classList.toggle('hidden')"
        class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-5 py-2 rounded-lg transition">
        + Add Promotion
    </button>
</div>

{{-- Add Form --}}
<div id="addForm" class="hidden bg-[#11161c] rounded-2xl p-6 mb-6">
    <h3 class="font-bold text-white mb-4">New Promotion</h3>
    <form action="{{ route('admin.promotions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="text-xs text-gray-400 block mb-1">Promo Code</label>
                <input type="text" name="pro_string" placeholder="e.g. SUMMER20"
                    class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none uppercase" required>
            </div>
            <div>
                <label class="text-xs text-gray-400 block mb-1">Discount Type</label>
                <select name="pro_discount_type"
                    class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
                    <option value="Percentage">Percentage (%)</option>
                    <option value="Fixed">Fixed ($)</option>
                </select>
            </div>
            <div>
                <label class="text-xs text-gray-400 block mb-1">Discount Value</label>
                <input type="number" name="pro_discount_value" placeholder="20" min="0" step="0.01"
                    class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="text-xs text-gray-400 block mb-1">Start Date</label>
                    <input type="datetime-local" name="pro_start_date"
                        class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
                </div>
                <div>
                    <label class="text-xs text-gray-400 block mb-1">End Date</label>
                    <input type="datetime-local" name="pro_end_date"
                        class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
                </div>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-6 py-2 rounded-lg transition">Save</button>
            <button type="button" onclick="document.getElementById('addForm').classList.add('hidden')"
                class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">Cancel</button>
        </div>
    </form>
</div>

{{-- Table --}}
<div class="bg-[#11161c] rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Code</th>
                <th class="px-4 py-3 text-center">Type</th>
                <th class="px-4 py-3 text-center">Value</th>
                <th class="px-4 py-3 text-center">Start</th>
                <th class="px-4 py-3 text-center">End</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($promotions as $p)
            @php
                $now = now();
                $start = \Carbon\Carbon::parse($p->pro_start_date);
                $end = \Carbon\Carbon::parse($p->pro_end_date);
                $active = $now->between($start, $end);
            @endphp
            <tr class="border-b border-gray-800/50 hover:bg-white/5 transition">
                <td class="px-5 py-4">
                    <span class="font-mono font-black text-yellow-400 text-sm tracking-widest">{{ $p->pro_string }}</span>
                </td>
                <td class="px-4 py-4 text-center">
                    <span class="text-xs px-2 py-1 rounded-full {{ $p->pro_discount_type == 'Percentage' ? 'bg-cyan-500/20 text-cyan-400' : 'bg-green-500/20 text-green-400' }}">
                        {{ $p->pro_discount_type }}
                    </span>
                </td>
                <td class="px-4 py-4 text-center font-bold text-white">
                    {{ $p->pro_discount_type == 'Percentage' ? $p->pro_discount_value.'%' : '$'.$p->pro_discount_value }}
                </td>
                <td class="px-4 py-4 text-center text-gray-400 text-xs">{{ \Carbon\Carbon::parse($p->pro_start_date)->format('d M Y') }}</td>
                <td class="px-4 py-4 text-center text-gray-400 text-xs">{{ \Carbon\Carbon::parse($p->pro_end_date)->format('d M Y') }}</td>
                <td class="px-4 py-4 text-center">
                    @if($active)
                        <span class="inline-flex items-center gap-1 text-xs text-green-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Active
                        </span>
                    @elseif($now->lt($start))
                        <span class="inline-flex items-center gap-1 text-xs text-yellow-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span> Upcoming
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Expired
                        </span>
                    @endif
                </td>
                <td class="px-4 py-4 text-center">
                    <form action="{{ route('admin.promotions.destroy', $p->pro_id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-400 transition"
                            onclick="return confirm('Delete this promotion?')">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-5 py-10 text-center text-gray-500">No promotions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
