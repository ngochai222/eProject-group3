@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-2">
    <div>
        <h2 class="text-2xl font-bold text-white">Show Time</h2>
        <p class="text-sm mt-1 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-cyan-400 inline-block"></span>
            <span class="text-cyan-400">Shift Active: Morning Matinee (08:00 - 16:00)</span>
        </p>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-gray-400 text-sm">User</span>
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
    </div>
</div>

<a href="{{ route('admin.showtimes.create') }}"
   class="inline-flex items-center gap-2 bg-yellow-400 text-black font-bold px-5 py-2 rounded-lg hover:bg-yellow-300 transition mb-4">
    <i class="fa fa-calendar-plus"></i> Assign Showtime
</a>

@if(session('error'))
    <div class="flex items-center justify-between bg-red-900/40 border border-red-500/30 rounded-xl px-5 py-3 mb-4 text-sm">
        <div class="flex items-center gap-3">
            <i class="fa fa-exclamation-triangle text-red-400"></i>
            <div>
                <p class="font-bold text-red-400">Scheduling Conflict Detected</p>
                <p class="text-gray-400 text-xs">{{ session('error') }}</p>
            </div>
        </div>
        <button class="text-yellow-400 font-bold text-xs hover:underline uppercase tracking-widest">Resolve Now</button>
    </div>
@endif

<div class="flex gap-6">

    {{-- CALENDAR --}}
    <div class="w-64 bg-[#11161c] p-4 rounded-xl flex-shrink-0">
        <h3 class="text-sm font-bold mb-3">{{ now()->format('F Y') }}</h3>

        <div class="grid grid-cols-7 text-center text-xs gap-1 text-gray-400 mb-2">
            @foreach(['M','T','W','T','F','S','S'] as $d)
                <div>{{ $d }}</div>
            @endforeach
        </div>

        <div class="grid grid-cols-7 text-center text-xs gap-1">
            @php $firstDay = now()->startOfMonth()->dayOfWeekIso - 1; @endphp
            @for($blank = 0; $blank < $firstDay; $blank++)
                <div></div>
            @endfor
            @for($i = 1; $i <= now()->daysInMonth; $i++)
                @php
                    $isToday = $i == now()->day;
                    $hasShowtime = in_array($i, $showtimeDates ?? []);
                @endphp
                <div class="cal-day relative p-1.5 rounded cursor-pointer hover:bg-gray-700
                    {{ $isToday ? 'bg-yellow-400 text-black font-bold' : 'text-gray-300' }}"
                    onclick="filterByDay({{ $i }}, this)">
                    {{ $i }}
                    @if($hasShowtime && !$isToday)
                        <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 bg-red-500 rounded-full"></span>
                    @endif
                </div>
            @endfor
        </div>

        <div class="mt-3 text-xs text-gray-500 text-center" id="selectedDayLabel">Click a day to filter</div>
        <button onclick="resetFilter()" class="mt-2 w-full text-xs text-gray-500 hover:text-white transition">↺ Show all</button>

        <div class="mt-4 text-xs text-gray-400 space-y-1 border-t border-gray-700 pt-3">
            <p class="flex items-center gap-1"><span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span> Has showtime</p>
            <p class="flex items-center gap-1"><span class="w-2 h-2 bg-yellow-400 rounded-full inline-block"></span> Today</p>
        </div>
    </div>

    {{-- SHOWTIME LIST --}}
    <div class="flex-1 space-y-4">

        @if(session('error'))
            <div class="bg-red-600/80 px-4 py-2 rounded text-sm">{{ session('error') }}</div>
        @endif

        @forelse($showtimes->groupBy(fn($s) => $s->movie_id) as $movieId => $items)
        @php $movie = $items->first()->movie; @endphp
        <div class="movie-row bg-[#11161c] p-4 rounded-xl flex items-center gap-4">

            <div class="w-16 h-20 rounded overflow-hidden flex-shrink-0 bg-gray-700">
                @if($movie && $movie->poster)
                    <img src="{{ asset('uploads/'.$movie->poster) }}" class="w-full h-full object-cover">
                @endif
            </div>

            <div class="flex-1">
                <h3 class="font-semibold mb-2">{{ $movie->title ?? 'Unknown' }}</h3>
                <div class="flex gap-2 flex-wrap">
                    @foreach($items as $s)
                    <span class="showtime-slot relative bg-black px-3 py-1.5 rounded text-sm border border-gray-700 cursor-pointer select-none hover:border-yellow-400 transition"
                          data-edit="{{ route('admin.showtimes.edit', $s->id) }}"
                          data-delete="{{ route('admin.showtimes.destroy', $s->id) }}"
                          data-day="{{ \Carbon\Carbon::parse($s->start_time)->day }}"
                          data-id="{{ $s->id }}"
                          oncontextmenu="showContext(event, this)">
                        {{ \Carbon\Carbon::parse($s->start_time)->format('H:i') }}
                    </span>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('admin.showtimes.create') }}"
               class="text-gray-400 text-2xl hover:text-yellow-400 transition">+</a>
        </div>
        @empty
        <div class="bg-[#11161c] p-8 rounded-xl text-center text-gray-500">No showtimes yet.</div>
        @endforelse

    </div>
</div>

{{-- CONTEXT MENU --}}
<div id="contextMenu" class="hidden fixed z-50 bg-[#1f2937] border border-gray-700 rounded-xl shadow-xl overflow-hidden w-40">
    <a id="ctxEdit" href="#"
       class="flex items-center gap-2 px-4 py-3 text-sm text-yellow-400 hover:bg-gray-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Edit
    </a>
    <form id="ctxDeleteForm" method="POST">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this showtime?')"
            class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-400 hover:bg-gray-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete
        </button>
    </form>
</div>

<script>
function filterByDay(day, el) {
    // Highlight selected day
    document.querySelectorAll('.cal-day').forEach(d => {
        d.classList.remove('ring-2', 'ring-white');
    });
    el.classList.add('ring-2', 'ring-white');

    document.getElementById('selectedDayLabel').textContent =
        'Showing: {{ now()->format("F") }} ' + day;

    document.querySelectorAll('.movie-row').forEach(row => {
        const slots = row.querySelectorAll('.showtime-slot');
        let hasMatch = false;
        slots.forEach(slot => {
            const match = parseInt(slot.dataset.day) === day;
            slot.style.display = match ? '' : 'none';
            if (match) hasMatch = true;
        });
        row.style.display = hasMatch ? '' : 'none';
    });
}

function resetFilter() {
    document.getElementById('selectedDayLabel').textContent = 'Click a day to filter';
    document.querySelectorAll('.movie-row').forEach(row => row.style.display = '');
    document.querySelectorAll('.showtime-slot').forEach(slot => slot.style.display = '');
    document.querySelectorAll('.cal-day').forEach(d => d.classList.remove('ring-2', 'ring-white'));
}

function showContext(e, el) {
    e.preventDefault();
    e.stopPropagation();
    const menu = document.getElementById('contextMenu');
    document.getElementById('ctxEdit').href = el.dataset.edit;
    document.getElementById('ctxDeleteForm').action = el.dataset.delete;
    menu.style.top = e.clientY + 'px';
    menu.style.left = e.clientX + 'px';
    menu.classList.remove('hidden');
}

document.addEventListener('click', (e) => {
    const menu = document.getElementById('contextMenu');
    if (!menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});
</script>

@endsection
