@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Ticket Pricing</h2>
        <p class="text-sm text-gray-500 mt-1">Set base price and surcharge % per day of week</p>
    </div>
</div>

<form action="{{ route('admin.pricing.update') }}" method="POST">
@csrf @method('PUT')

<div class="bg-[#11161c] rounded-2xl overflow-hidden">
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
            @php $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; @endphp
            @foreach($pricing as $p)
            <tr class="border-b border-gray-800/50 hover:bg-white/5">
                <td class="px-5 py-4">
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
                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-gray-400">$</span>
                        <input type="number" name="prices[{{ $p->id }}]"
                            value="{{ $p->base_price }}"
                            min="0" step="0.5"
                            class="w-24 px-3 py-1.5 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-center"
                            oninput="updateRow({{ $p->id }})">
                    </div>
                </td>
                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <input type="number" name="surcharge_percent[{{ $p->id }}]"
                            value="{{ $p->surcharge_percent }}"
                            min="0" max="500" step="1"
                            class="w-20 px-3 py-1.5 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-center"
                            oninput="updateRow({{ $p->id }})">
                        <span class="text-gray-500">%</span>
                    </div>
                </td>
                <td class="px-4 py-4 text-center">
                    <span id="final_{{ $p->id }}" class="font-black text-yellow-400 text-lg">
                        ${{ number_format($p->base_price * (1 + $p->surcharge_percent / 100), 2) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="flex justify-end mt-6">
    <button type="submit"
        class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-8 py-3 rounded-xl transition">
        Save Pricing
    </button>
</div>
</form>

<script>
function updateRow(id) {
    const base = parseFloat(document.querySelector('[name="prices[' + id + ']"]').value) || 0;
    const pct  = parseFloat(document.querySelector('[name="surcharge_percent[' + id + ']"]').value) || 0;
    document.getElementById('final_' + id).textContent = '$' + (base * (1 + pct / 100)).toFixed(2);
}
</script>

@endsection
