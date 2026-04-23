@extends('managers.layout.layout')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Customer Accounts</h2>

    </div>
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-3 gap-6">

    {{-- LEFT: LIST --}}
    <div class="col-span-2 space-y-4">

        {{-- SEARCH --}}
        <div class="relative">
            <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <input type="text" id="searchInput" placeholder="Search customers by name, ID or email..."
                class="w-full bg-[#11161c] text-white text-sm pl-8 pr-4 py-3 rounded-xl border border-gray-700 focus:border-yellow-400 outline-none">
        </div>

        {{-- TABLE --}}
        <div class="bg-[#11161c] rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                        <th class="px-5 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr class="customer-row border-b border-gray-800/50 hover:bg-white/5 transition cursor-pointer
                        {{ isset($selected) && $selected->customer_id == $customer->customer_id ? 'bg-white/5' : '' }}"
                        data-name="{{ strtolower($customer->customer_name) }} {{ strtolower($customer->customer_email) }}"
                        onclick="window.location='/admin/customers/{{ $customer->customer_id }}'">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                @if($customer->customer_avatar)
                                    <img src="{{ asset($customer->customer_avatar) }}"
                                         class="w-9 h-9 rounded-full object-cover flex-shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-yellow-400 flex items-center justify-center flex-shrink-0">
                                        <span class="text-black font-bold text-sm">{{ strtoupper(substr($customer->customer_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-white">{{ $customer->customer_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $customer->customer_email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center gap-1 text-xs text-green-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Active
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center font-bold text-white">
                            {{ number_format(rand(100, 30000)) }}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-10 text-center text-gray-500">No customers found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="flex justify-between items-center px-5 py-3 border-t border-gray-800 text-xs text-gray-500">
                <p>Showing {{ $customers->firstItem() }}-{{ $customers->lastItem() }} of {{ $customers->total() }} customers</p>
                <div class="flex gap-1">
                    @if($customers->previousPageUrl())
                        <a href="{{ $customers->previousPageUrl() }}" class="w-7 h-7 flex items-center justify-center rounded bg-gray-800 hover:bg-gray-700">‹</a>
                    @endif
                    @if($customers->nextPageUrl())
                        <a href="{{ $customers->nextPageUrl() }}" class="w-7 h-7 flex items-center justify-center rounded bg-gray-800 hover:bg-gray-700">›</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- BOTTOM STATS --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#11161c] rounded-xl p-5">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Account</p>
                <h2 class="text-3xl font-black text-yellow-400">{{ str_pad($customers->total(), 2, '0', STR_PAD_LEFT) }}</h2>
            </div>
            <div class="bg-[#11161c] rounded-xl p-5">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Active Locations</p>
                <h2 class="text-3xl font-black text-cyan-400">{{ str_pad($totalActive, 2, '0', STR_PAD_LEFT) }}</h2>
            </div>
        </div>
    </div>

    {{-- RIGHT: DETAIL --}}
    @if(isset($selected))
    <div class="space-y-4">

        {{-- PROFILE CARD --}}
        <div class="bg-[#11161c] rounded-2xl p-5">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-3 items-center">
                    @if($selected->customer_avatar)
                        <img src="{{ asset($selected->customer_avatar) }}" class="w-14 h-14 rounded-xl object-cover">
                    @else
                        <div class="w-14 h-14 rounded-xl bg-yellow-400 flex items-center justify-center">
                            <span class="text-black font-black text-xl">{{ strtoupper(substr($selected->customer_name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <h3 class="font-black text-white text-lg">{{ $selected->customer_name }}</h3>
            <p class="text-xs text-gray-500 mb-4">Customer ID: CK-{{ str_pad($selected->customer_id, 5, '0', STR_PAD_LEFT) }}</p>

            <div class="grid grid-cols-2 gap-3 mb-4">
                @php
                    $totalBookings = \DB::table('bookings')->where('customer_name', $selected->customer_name)->count();
                    $lifetimeSales = \DB::table('bookings')->where('customer_name', $selected->customer_name)->sum('total_price');
                @endphp
                <div class="bg-black rounded-xl p-3">
                    <p class="text-xs text-gray-500 mb-1">Lifetime Sales</p>
                    <p class="font-black text-yellow-400">${{ number_format($lifetimeSales, 2) }}</p>
                </div>
                <div class="bg-black rounded-xl p-3">
                    <p class="text-xs text-gray-500 mb-1">Total Bookings</p>
                    <p class="font-black text-cyan-400">{{ $totalBookings }}</p>
                </div>
            </div>

            <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Account Controls</p>
            <div class="flex gap-2">
                <button class="flex-1 py-2 bg-gray-700 hover:bg-gray-600 rounded text-white text-sm font-semibold transition">
                    Edit Profile
                </button>
                <button class="flex-1 py-2 bg-red-600/20 hover:bg-red-600/40 border border-red-600/30 rounded text-red-400 text-sm font-semibold transition">
                    Suspend
                </button>
            </div>
        </div>

        {{-- RECENT BOOKINGS --}}
        <div class="bg-[#11161c] rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <p class="text-xs text-gray-500 uppercase tracking-widest">Recent Bookings</p>
                <a href="#" class="text-xs text-cyan-400 hover:underline">View All</a>
            </div>
            @php
                $recentBookings = \DB::table('bookings')
                    ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
                    ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
                    ->where('bookings.customer_name', $selected->customer_name)
                    ->select('movies.title', 'movies.poster', 'showtimes.start_time', 'bookings.total_price', 'bookings.status')
                    ->orderByDesc('bookings.created_at')
                    ->limit(3)
                    ->get();
            @endphp
            @forelse($recentBookings as $b)
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ $b->poster ? asset('uploads/'.$b->poster) : 'https://via.placeholder.com/40x56?text=?' }}"
                     class="w-10 h-14 rounded object-cover flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ $b->title }}</p>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($b->start_time)->format('d M Y · H:i') }}</p>
                    <p class="text-xs text-green-400 font-bold">${{ number_format($b->total_price, 2) }}</p>
                </div>
            </div>
            @empty
            <div class="text-sm text-gray-500 text-center py-4">No bookings yet.</div>
            @endforelse
        </div>

    </div>
    @endif

</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.customer-row').forEach(row => {
        row.style.display = row.dataset.name.includes(q) ? '' : 'none';
    });
});
</script>

@endsection


