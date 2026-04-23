@extends('managers.layout.layout')

@section('content')

@php
    $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    $maxPrice = $pricing->max('base_price') ?: 1;
    $avgPrice = $pricing->avg('base_price');
    $weekendSurcharge = $pricing->whereIn('day_of_week',[0,6])->avg('surcharge_percent') ?? 0;
@endphp

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Price</h2>
    <a href="/managers/profile" class="flex items-center gap-2 hover:opacity-80 transition" style="text-decoration:none">
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
        <span class="text-gray-400 text-sm">{{ session('manager_name', 'User') }}</span>
    </a>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">

    {{-- CALENDAR --}}
    <div class="bg-[#11161c] rounded-2xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-white" id="calTitle">{{ now()->format('F Y') }}</h3>
            <div class="flex gap-1">
                <button type="button" onclick="changeCalMonth(-1)" class="w-7 h-7 rounded bg-gray-800 text-gray-400 hover:bg-gray-700 text-xs">‹</button>
                <button type="button" onclick="changeCalMonth(1)" class="w-7 h-7 rounded bg-gray-800 text-gray-400 hover:bg-gray-700 text-xs">›</button>
            </div>
        </div>
        <div class="grid grid-cols-7 text-center text-xs text-gray-500 mb-2">
            @foreach(['M','T','W','T','F','S','S'] as $d)<div>{{ $d }}</div>@endforeach
        </div>
        <div id="calDays" class="grid grid-cols-7 text-center text-xs gap-y-2"></div>
    </div>

    {{-- WEEKLY PREVIEW CHART --}}
    <div class="bg-[#11161c] rounded-2xl p-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="font-bold text-white">Weekly Preview</h3>
                <p class="text-xs text-gray-500">AVG ${{ number_format($avgPrice, 2) }}</p>
            </div>
        </div>
        <div class="flex items-end gap-2 px-2" style="height:120px;">
            @foreach($pricing->sortBy('day_of_week') as $p)
            @php $px = max(12, round(($p->base_price / $maxPrice) * 100)); @endphp
            <div class="flex-1 flex flex-col items-center gap-1 h-full justify-end">
                <div class="w-full rounded-t cursor-pointer relative group"
                     style="height:{{ $px }}px; background: {{ in_array($p->day_of_week,[0,6]) ? '#facc15' : '#22d3ee' }};">
                    <div class="hidden group-hover:block absolute -top-7 left-1/2 -translate-x-1/2 bg-black text-white text-[10px] px-2 py-0.5 rounded whitespace-nowrap z-10">
                        ${{ number_format($p->base_price * (1 + $p->surcharge_percent/100), 2) }}
                    </div>
                </div>
                <span class="text-[9px] text-gray-600">{{ substr($days[$p->day_of_week], 0, 3) }}</span>
            </div>
            @endforeach
        </div>
        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-800">
            <span class="w-2 h-2 rounded-full bg-cyan-400 inline-block"></span>
            <span class="text-[10px] text-gray-500">Weekend Price Active (+{{ number_format($weekendSurcharge, 0) }}%)</span>
        </div>
    </div>
</div>

{{-- PRICING TABLE --}}
<form action="{{ route('admin.pricing.update') }}" method="POST">
@csrf @method('PUT')

<div id="pricing-table" class="bg-[#11161c] rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center">
        <h3 class="font-bold text-white">Day-by-Day Pricing</h3>
        <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-5 py-2 rounded-lg text-sm transition">
            Save Changes
        </button>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Day</th>
                <th class="px-4 py-3 text-center">Base Price ($)</th>
                <th class="px-4 py-3 text-center">Surcharge %</th>
                <th class="px-4 py-3 text-center">Final Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pricing->sortBy('day_of_week') as $p)
            <tr class="border-b border-gray-800/50 hover:bg-white/5">
                <td class="px-5 py-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                            {{ in_array($p->day_of_week, [0,6]) ? 'bg-yellow-400/20 text-yellow-400' : 'bg-gray-700 text-gray-300' }}">
                            {{ substr($days[$p->day_of_week], 0, 2) }}
                        </div>
                        <span class="font-semibold text-white">{{ $days[$p->day_of_week] }}</span>
                        @if(in_array($p->day_of_week, [0,6]))
                            <span class="text-xs bg-yellow-400/10 text-yellow-400 px-2 py-0.5 rounded-full">Weekend</span>
                        @endif
                    </div>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-gray-400">$</span>
                        <input type="number" name="prices[{{ $p->id }}]" value="{{ $p->base_price }}"
                            min="0" step="0.5"
                            class="w-20 px-2 py-1 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-center text-sm"
                            oninput="updateRow({{ $p->id }})">
                    </div>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <input type="number" name="surcharge_percent[{{ $p->id }}]" value="{{ $p->surcharge_percent }}"
                            min="0" max="500" step="1"
                            class="w-16 px-2 py-1 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-center text-sm"
                            oninput="updateRow({{ $p->id }})">
                        <span class="text-gray-500 text-xs">%</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-center">
                    <span id="final_{{ $p->id }}" class="font-black text-yellow-400">
                        ${{ number_format($p->base_price * (1 + $p->surcharge_percent / 100), 2) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</form>

<script>
// Calendar
let calYear = {{ now()->year }};
let calMonth = {{ now()->month - 1 }}; // 0-indexed
const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
const today = new Date();

function renderCal() {
    document.getElementById('calTitle').textContent = months[calMonth] + ' ' + calYear;
    const firstDay = new Date(calYear, calMonth, 1).getDay();
    const offset = firstDay === 0 ? 6 : firstDay - 1;
    const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
    let html = '';
    for (let i = 0; i < offset; i++) html += '<div></div>';
    for (let d = 1; d <= daysInMonth; d++) {
        const dow = new Date(calYear, calMonth, d).getDay();
        const isWeekend = dow === 0 || dow === 6;
        const isToday = d === today.getDate() && calMonth === today.getMonth() && calYear === today.getFullYear();
        html += `<div class="py-1.5 rounded cursor-pointer ${isToday ? 'bg-yellow-400 text-black font-black' : (isWeekend ? 'text-yellow-400' : 'text-gray-400 hover:bg-gray-800')}">${d}</div>`;
    }
    document.getElementById('calDays').innerHTML = html;
}

function changeCalMonth(dir) {
    calMonth += dir;
    if (calMonth > 11) { calMonth = 0; calYear++; }
    if (calMonth < 0)  { calMonth = 11; calYear--; }
    renderCal();
}

renderCal();

// Pricing
function updateRow(id) {
    const base = parseFloat(document.querySelector('[name="prices[' + id + ']"]').value) || 0;
    const pct  = parseFloat(document.querySelector('[name="surcharge_percent[' + id + ']"]').value) || 0;
    document.getElementById('final_' + id).textContent = '$' + (base * (1 + pct / 100)).toFixed(2);
}
</script>

@endsection
