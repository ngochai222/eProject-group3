<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Tickets - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-[#121212] text-white">

@include('components.header')

<div class="pt-20 pb-16 px-4 md:px-10 max-w-3xl mx-auto">

    <h2 class="text-2xl font-black uppercase mb-1">My Tickets</h2>
    <p class="text-gray-500 text-sm mb-8">{{ $bookings->count() }} booking(s)</p>

    @if($bookings->isEmpty())
        <div class="bg-white/5 rounded-2xl p-12 text-center">
            <span class="material-icons text-5xl text-gray-600 mb-4 block">confirmation_number</span>
            <p class="text-gray-500">You haven't bought any tickets yet.</p>
            <a href="{{ url('/') }}" class="mt-4 inline-block bg-[#E50914] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-full transition">
                Browse Movies
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($bookings as $b)
            <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden flex">
                {{-- Poster --}}
                <div class="w-24 flex-shrink-0">
                    <img src="{{ $b->poster ? asset('uploads/'.$b->poster) : 'https://via.placeholder.com/100x140?text=No+Image' }}"
                         class="w-full h-full object-cover" alt="{{ $b->title }}">
                </div>

                {{-- Info --}}
                <div class="flex-1 p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-black uppercase text-white">{{ $b->title }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $b->genre }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full font-bold
                            {{ $b->status == 'confirmed' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-3 text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <span class="material-icons text-sm">calendar_today</span>
                            {{ \Carbon\Carbon::parse($b->start_time)->format('D, d M Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-icons text-sm">schedule</span>
                            {{ \Carbon\Carbon::parse($b->start_time)->format('H:i') }}
                            @if($b->end_time) – {{ \Carbon\Carbon::parse($b->end_time)->format('H:i') }} @endif
                        </span>
                        @if($b->seats)
                        <span class="flex items-center gap-1">
                            <span class="material-icons text-sm">event_seat</span>
                            {{ $b->seats }}
                        </span>
                        @endif
                    </div>

                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-xs text-gray-600">Booking #{{ $b->id }}</span>
                        <span class="font-black text-yellow-400">${{ number_format($b->total_price, 2) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>

</body>
</html>
