<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinebook Showtime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">

@include('components.header')

<div class="pt-20 px-6 md:px-10 pb-16">

    <h2 class="text-2xl md:text-3xl font-black uppercase italic mb-6">Show Times</h2>

    {{-- DATE PICKER --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2 text-sm text-gray-400">
                <i class="fa fa-calendar text-yellow-400"></i>
                <span id="monthLabel" class="font-bold text-white"></span>
            </div>
            <div class="flex gap-2">
                <button onclick="shiftWeek(-1)" class="w-8 h-8 rounded-lg bg-gray-800 hover:bg-gray-700 flex items-center justify-center text-gray-400 hover:text-white transition">‹</button>
                <button onclick="shiftWeek(1)" class="w-8 h-8 rounded-lg bg-gray-800 hover:bg-gray-700 flex items-center justify-center text-gray-400 hover:text-white transition">›</button>
            </div>
        </div>
        <div class="flex gap-3 overflow-x-auto pb-2 justify-center" id="datePicker" style="scrollbar-width:none"></div>
    </div>

    @if($showtimes->isEmpty())
        <div class="text-center text-gray-500 py-20">
            <p class="text-lg">No showtimes available at the moment.</p>
        </div>
    @else
        @foreach($showtimes as $date => $items)
            <div class="showtime-group mb-10" data-date="{{ $date }}">
                <h3 class="text-[#E50914] font-bold uppercase tracking-widest text-sm mb-4">
                    {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                </h3>

                <div class="space-y-6">
                    @foreach($items as $showtime)
                    <div class="flex gap-6 bg-white/5 rounded-2xl p-4 border border-white/10">
                        {{-- Poster --}}
                        <img
                            src="{{ $showtime->movie->poster ? asset('uploads/' . $showtime->movie->poster) : 'https://via.placeholder.com/100x140?text=No+Image' }}"
                            class="w-20 h-28 rounded-lg object-cover flex-shrink-0"
                            alt="{{ $showtime->movie->title }}"
                        >

                        <div class="flex-1">
                            <h4 class="text-lg font-bold mb-1">{{ $showtime->movie->title }}</h4>
                            <div class="flex gap-4 text-sm text-gray-400 mb-3">
                                @if($showtime->movie->genre)
                                    <span>🎬 {{ $showtime->movie->genre }}</span>
                                @endif
                                @if($showtime->movie->duration)
                                    <span>⏱ {{ $showtime->movie->duration }} min</span>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('movie.detail', $showtime->movie->id) }}"
                                   class="bg-gray-800 hover:bg-[#E50914] px-4 py-2 rounded-lg text-sm font-bold transition">
                                    {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                    @if($showtime->end_time)
                                        – {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

</div>

<script>
const days = ['SUN','MON','TUE','WED','THU','FRI','SAT'];
const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
let startOffset = 0;
let selectedDate = null;

// Dates that have showtimes
const showtimeDates = @json($showtimes->keys()->toArray());

function renderDates() {
    const picker = document.getElementById('datePicker');
    const today = new Date();
    picker.innerHTML = '';

    for (let i = 0; i < 8; i++) {
        const d = new Date(today);
        d.setDate(today.getDate() + startOffset + i);

        const dateStr = d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
        const isToday = i === 0 && startOffset === 0;
        const isSelected = dateStr === selectedDate;
        const hasShowtime = showtimeDates.includes(dateStr);

        const btn = document.createElement('button');
        btn.onclick = () => filterByDate(dateStr);
        btn.className = `flex-shrink-0 flex flex-col items-center justify-center w-16 h-20 rounded-2xl transition font-bold
            ${isSelected ? 'bg-yellow-400 text-black' : 'bg-[#1f1f1f] text-white hover:bg-gray-700'}`;
        btn.innerHTML = `
            <span class="text-[10px] uppercase tracking-widest ${isSelected ? 'text-black/70' : 'text-gray-500'}">${days[d.getDay()]}</span>
            <span class="text-2xl font-black">${d.getDate()}</span>
            ${hasShowtime ? `<span class="w-1.5 h-1.5 rounded-full mt-1 ${isSelected ? 'bg-black/50' : 'bg-yellow-400'}"></span>` : '<span class="w-1.5 h-1.5 mt-1"></span>'}
        `;
        picker.appendChild(btn);
    }

    // Update month label
    const refDate = new Date(today);
    refDate.setDate(today.getDate() + startOffset);
    document.getElementById('monthLabel').textContent = months[refDate.getMonth()] + ' ' + refDate.getFullYear();
}

function shiftWeek(dir) {
    startOffset += dir * 7;
    if (startOffset < 0) startOffset = 0;
    renderDates();
}

function filterByDate(dateStr) {
    selectedDate = dateStr;
    renderDates();

    // Show/hide showtime groups
    document.querySelectorAll('.showtime-group').forEach(group => {
        group.style.display = group.dataset.date === dateStr ? '' : 'none';
    });
}

renderDates();
</script>

</body>
</html>
