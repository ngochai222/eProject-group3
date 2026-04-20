@extends('admin.layout.layout')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Welcome back.</h2>
        <p class="text-sm mt-1 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-cyan-400 inline-block"></span>
            <span class="text-cyan-400">Shift Active: Morning Matinee (08:00 - 16:00)</span>
        </p>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-gray-400 text-sm">{{ session('admin_email', 'Admin') }}</span>
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-3 gap-6">

    {{-- LEFT COLUMN --}}
    <div class="col-span-2 space-y-6">

        {{-- WEEKLY ROSTER --}}
        <div class="bg-[#11161c] rounded-xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-white">Weekly Roster</h3>
                <i class="fa fa-calendar text-gray-400"></i>
            </div>
            <div class="space-y-3">
                @php
                $roster = [
                    ['day' => 'TODAY', 'time' => '08:00 - 16:00', 'shift' => 'Matinee Duty', 'active' => true],
                    ['day' => 'TUESDAY', 'time' => '14:00 - 22:00', 'shift' => 'Evening Lead', 'active' => false],
                    ['day' => 'WEDNESDAY', 'time' => '3 FF', 'shift' => 'No shifts', 'active' => false],
                    ['day' => 'THURSDAY', 'time' => '08:00 - 16:00', 'shift' => 'Matinee Duty', 'active' => false],
                ];
                @endphp
                @foreach($roster as $r)
                <div class="flex items-center justify-between p-3 rounded-lg {{ $r['active'] ? 'border-l-4 border-yellow-400 bg-white/5' : 'bg-white/3' }}">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">{{ $r['day'] }}</p>
                        <p class="font-bold text-white">{{ $r['time'] }}</p>
                    </div>
                    <span class="text-xs text-gray-400">{{ $r['shift'] }}</span>
                </div>
                @endforeach
            </div>
            <a href="#" class="text-cyan-400 text-sm mt-4 inline-block hover:underline">Request a shift swap →</a>
        </div>

        {{-- RECENT INQUIRIES --}}
        <div class="bg-[#11161c] rounded-xl p-5">
            <h3 class="font-bold text-white mb-4">Recent Inquiries</h3>
            <div class="space-y-3">
                <div class="bg-[#0f172a] rounded-xl p-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs font-bold text-red-400 bg-red-400/10 px-2 py-0.5 rounded">URGENT</span>
                        <span class="text-xs text-gray-500">12:45 PM</span>
                    </div>
                    <p class="text-xs text-gray-400 mb-1">Row F, Seat 12</p>
                    <p class="text-sm text-white">"The AC in Theater 4 seems a bit too high. Several guests are..."</p>
                    <button class="text-yellow-400 text-xs font-bold mt-2 hover:underline">RESPOND NOW</button>
                </div>
                <div class="bg-[#0f172a] rounded-xl p-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs font-bold text-cyan-400 bg-cyan-400/10 px-2 py-0.5 rounded">GENERAL</span>
                        <span class="text-xs text-gray-500">1:00 PM</span>
                    </div>
                    <p class="text-xs text-gray-400 mb-1">Lobby Service</p>
                    <p class="text-sm text-white">"Can someone confirm if the 3D glasses for the next show are..."</p>
                    <button class="text-yellow-400 text-xs font-bold mt-2 hover:underline">RESPOND NOW</button>
                </div>
            </div>
        </div>

        {{-- BOTTOM STATS --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#11161c] rounded-xl p-5">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Incident Reports</p>
                <h2 class="text-3xl font-black text-white">{{ $totalReviews ?? 0 }}</h2>
                <p class="text-xs text-gray-500 mt-1">No reports filed in last 24h</p>
            </div>
            <div class="bg-[#11161c] rounded-xl p-5">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Theater Occupancy</p>
                <h2 class="text-3xl font-black text-white">84%</h2>
                <div class="w-full bg-gray-700 rounded-full h-1.5 mt-2">
                    <div class="bg-yellow-400 h-1.5 rounded-full" style="width:84%"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div class="space-y-6">

        {{-- OPEN FEEDBACK --}}
        <div class="bg-cyan-900/40 border border-cyan-500/30 rounded-xl p-5">
            <p class="text-cyan-400 text-sm font-bold flex items-center gap-2 mb-2">
                <i class="fa fa-comment"></i> Open Feedback
            </p>
            <h2 class="text-3xl font-black text-white">{{ $totalReviews ?? 0 }} Pending</h2>
            <p class="text-xs text-gray-400 mt-1">Average response time: 14m</p>
        </div>

        {{-- DAILY OPERATIONS --}}
        <div class="bg-[#11161c] rounded-xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-white">Daily Operations</h3>
                <span class="text-xs text-yellow-400 font-bold">4 of 6 Completed</span>
            </div>
            @php
            $tasks = [
                ['label' => 'Check theater 4 cleaning', 'done' => true],
                ['label' => 'Update lobby digital displays', 'done' => true],
                ['label' => 'Restock premium concession', 'done' => true],
                ['label' => 'Verify VIP lounge access list', 'done' => true],
                ['label' => 'Inspect projection booth 12', 'done' => false],
                ['label' => 'Submit end-of-shift report', 'done' => false],
            ];
            @endphp
            <div class="space-y-3">
                @foreach($tasks as $task)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" {{ $task['done'] ? 'checked' : '' }}
                        class="w-4 h-4 accent-yellow-400 rounded">
                    <span class="text-sm {{ $task['done'] ? 'line-through text-gray-500' : 'text-gray-300' }}">
                        {{ $task['label'] }}
                    </span>
                </label>
                @endforeach
            </div>
        </div>

        {{-- QUICK STATS --}}
        <div class="bg-[#11161c] rounded-xl p-5 space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-400 text-sm">Total Movies</span>
                <span class="font-bold text-white">{{ $totalMovies ?? 0 }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 text-sm">Showtimes</span>
                <span class="font-bold text-white">{{ $totalShowtimes ?? 0 }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 text-sm">Avg Rating</span>
                <span class="font-bold text-cyan-400">{{ $avgRating ? number_format($avgRating, 1) : '—' }}</span>
            </div>
        </div>

    </div>
</div>

@endsection
