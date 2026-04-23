@extends('managers.layout.layout')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Tickets</h2>

    </div>
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="bg-[#11161c] rounded-2xl p-6 col-span-1">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Today's Revenue</p>
        <h2 class="text-3xl font-black text-white">${{ number_format($todayRevenue, 2) }}</h2>
        <p class="text-xs text-green-400 mt-2 flex items-center gap-1">
            <i class="fa fa-arrow-up text-[10px]"></i> Live data
        </p>
    </div>
    <div class="bg-[#11161c] rounded-2xl p-6">
        <div class="flex justify-between items-start mb-2">
            <p class="text-xs text-gray-500 uppercase tracking-widest">Active</p>
            <i class="fa fa-ticket text-cyan-400 text-xs"></i>
        </div>
        <h2 class="text-3xl font-black text-white">{{ $totalBooked }}</h2>
        <p class="text-xs text-gray-500 mt-2">Tickets Booked</p>
    </div>
    <div class="bg-[#11161c] rounded-2xl p-6">
        <div class="flex justify-between items-start mb-2">
            <p class="text-xs text-gray-500 uppercase tracking-widest">Validated</p>
            <i class="fa fa-check-circle text-yellow-400 text-xs"></i>
        </div>
        <h2 class="text-3xl font-black text-white">{{ $validated }}</h2>
        <p class="text-xs text-gray-500 mt-2">Already Confirmed</p>
    </div>
</div>

{{-- RECENT TRANSACTIONS --}}
<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Recent Transactions</h3>
        <div class="flex gap-2">
            <button onclick="filterStatus('all')" id="btn-all"
                class="px-3 py-1 rounded text-xs font-bold bg-gray-700 text-white">All</button>
            <button onclick="filterStatus('confirmed')" id="btn-confirmed"
                class="px-3 py-1 rounded text-xs font-bold bg-transparent text-gray-400 hover:bg-gray-700 transition">Validated</button>
            <button onclick="filterStatus('pending')" id="btn-pending"
                class="px-3 py-1 rounded text-xs font-bold bg-transparent text-gray-400 hover:bg-gray-700 transition">Pending</button>
        </div>
    </div>

    <div class="bg-[#11161c] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-600 text-xs uppercase tracking-widest border-b border-gray-800">
                    <th class="px-5 py-3 text-left">Ticket ID</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Movie / Showtime</th>
                    <th class="px-4 py-3 text-center">Seats</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Total</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="ticketTable">
                @forelse($bookings as $b)
                <tr class="ticket-row border-b border-gray-800/50 hover:bg-white/5 transition"
                    data-status="{{ $b->status }}">
                    <td class="px-5 py-4">
                        <span class="text-xs font-mono text-gray-400">#TF-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <p class="font-semibold text-white">{{ $b->customer_name }}</p>
                        <p class="text-xs text-gray-500">{{ $b->customer_email }}</p>
                    </td>
                    <td class="px-4 py-4">
                        <p class="font-semibold text-white text-sm">{{ $b->movie_title ?? '—' }}</p>
                        @if($b->start_time)
                            <p class="text-xs text-cyan-400">{{ \Carbon\Carbon::parse($b->start_time)->format('D d M · H:i') }}</p>
                        @endif
                    </td>
                <td class="px-4 py-4 text-center">
                    @if($b->seats)
                        <span class="bg-yellow-400/20 text-yellow-400 text-xs font-bold px-2 py-1 rounded">{{ $b->seats }}</span>
                    @else
                        <span class="text-gray-600">—</span>
                    @endif
                </td>

                    <td class="px-4 py-4 text-center">
                        @if($b->status == 'confirmed')
                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-green-500/20 text-green-400 uppercase tracking-widest">Validated</span>
                        @elseif($b->status == 'cancelled')
                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-red-500/20 text-red-400 uppercase tracking-widest">Cancelled</span>
                        @else
                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-yellow-500/20 text-yellow-400 uppercase tracking-widest">Pending</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center font-bold text-yellow-400">
                        ${{ number_format($b->total_price, 2) }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        <form action="{{ route('admin.tickets.destroy', $b->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-400 transition"
                                onclick="return confirm('Delete this booking?')">
                                <i class="fa fa-trash text-xs"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-gray-500">No bookings yet.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex justify-between items-center px-5 py-3 border-t border-gray-800 text-xs text-gray-500">
            <p>Showing {{ $bookings->firstItem() ?? 0 }} to {{ $bookings->lastItem() ?? 0 }} of {{ $bookings->total() }} tickets</p>
            <div class="flex gap-1">
                @if($bookings->previousPageUrl())
                    <a href="{{ $bookings->previousPageUrl() }}" class="w-7 h-7 flex items-center justify-center rounded bg-gray-800 hover:bg-gray-700">‹</a>
                @endif
                @if($bookings->nextPageUrl())
                    <a href="{{ $bookings->nextPageUrl() }}" class="w-7 h-7 flex items-center justify-center rounded bg-gray-800 hover:bg-gray-700">›</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function filterStatus(status) {
    document.querySelectorAll('[id^="btn-"]').forEach(b => {
        b.className = 'px-3 py-1 rounded text-xs font-bold bg-transparent text-gray-400 hover:bg-gray-700 transition';
    });
    document.getElementById('btn-' + status).className = 'px-3 py-1 rounded text-xs font-bold bg-gray-700 text-white';

    document.querySelectorAll('.ticket-row').forEach(row => {
        if (status === 'all') {
            row.style.display = '';
        } else {
            row.style.display = row.dataset.status === status ? '' : 'none';
        }
    });
}
</script>

@endsection


