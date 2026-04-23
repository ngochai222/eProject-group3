@extends('managers.layout.layout')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-white">Welcome back, {{ session('manager_name', 'Manager') }}</h2>
    </div>
    <a href="/managers/profile" class="flex items-center gap-2 hover:opacity-80 transition no-underline" style="text-decoration:none">
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
        <span class="text-gray-400 text-sm">{{ session('manager_name', session('admin_email', 'Manager')) }}</span>
    </a>
</div>

{{-- MY PERMISSIONS --}}
@php $myPerms = (array)(session('manager_permissions') ?? []); @endphp
@if(count($myPerms) > 0)
<div class="bg-[#11161c] rounded-2xl p-5 mb-6">
    <h3 class="font-bold text-white mb-3 text-sm">My Access</h3>
    <div class="flex flex-wrap gap-2">
        @foreach($myPerms as $perm)
        <a href="/managers/{{ $perm }}"
           class="flex items-center gap-1.5 bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-cyan-500/20 transition">
            @php
                $icons = ['movies'=>'fa-film','showtimes'=>'fa-clock','cinemas'=>'fa-building','seats'=>'fa-th','tickets'=>'fa-ticket','reviews'=>'fa-star','customers'=>'fa-users','pricing'=>'fa-tag','promotions'=>'fa-percent'];
            @endphp
            <i class="fa {{ $icons[$perm] ?? 'fa-circle' }} text-[10px]"></i>
            {{ ucfirst($perm) }}
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- REVENUE ANALYTICS --}}
<div class="bg-[#11161c] rounded-2xl p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-lg">Revenue Analytics</h3>
            <p class="text-xs text-gray-500 mt-0.5">Weekly ticket sales performance</p>
        </div>
        <div class="flex gap-1 bg-[#0f172a] rounded-lg p-1">
            <button onclick="setView('day')" id="btn-day" class="px-3 py-1 rounded text-xs font-bold text-gray-400 hover:text-white transition">Day</button>
            <button onclick="setView('week')" id="btn-week" class="px-3 py-1 rounded text-xs font-bold bg-cyan-500 text-black transition">Week</button>
            <button onclick="setView('month')" id="btn-month" class="px-3 py-1 rounded text-xs font-bold text-gray-400 hover:text-white transition">Month</button>
        </div>
    </div>

    {{-- Bar Chart --}}
    <div class="flex items-end gap-3 px-2" style="height: 160px;">
        @foreach($revenueByDay ?? [] as $d)
        @php
            $px = $maxRevenue > 0 ? max(20, round(($d['revenue'] / $maxRevenue) * 140)) : 40;
        @endphp
        <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
            <div class="w-full rounded-t-lg transition-all duration-500 relative group cursor-pointer"
                 style="height: {{ $px }}px; background: {{ $d['isWeekend'] ? '#facc15' : '#22d3ee' }};">
                {{-- Tooltip --}}
                <div class="hidden group-hover:block absolute -top-8 left-1/2 -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded whitespace-nowrap z-10">
                    ${{ number_format($d['revenue'], 0) }}
                </div>
            </div>
            <span class="text-[10px] text-gray-500 uppercase">{{ $d['day'] }}</span>
        </div>
        @endforeach
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-3 gap-4 mt-5 pt-4 border-t border-gray-800">
        <div>
            <p class="text-xs text-gray-500 mb-1">This Week</p>
            <p class="font-black text-white">${{ number_format(array_sum(array_column($revenueByDay ?? [], 'revenue')), 2) }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500 mb-1">Today</p>
            <p class="font-black text-cyan-400">${{ number_format(\DB::table('bookings')->whereDate('created_at', today())->sum('total_price'), 2) }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500 mb-1">Total Bookings</p>
            <p class="font-black text-yellow-400">{{ \DB::table('bookings')->count() }}</p>
        </div>
    </div>
</div>

{{-- TASKS --}}
<div class="bg-[#11161c] rounded-2xl p-6">
    <div class="flex justify-between items-center mb-5">
        <h3 class="font-bold text-white text-lg">My Tasks & Schedule</h3>
        @php
            $pendingCount = isset($myTasks) ? $myTasks->where('status', 'pending')->count() : 0;
        @endphp
        @if($pendingCount > 0)
            <span class="bg-red-500/20 text-red-400 text-xs font-bold px-3 py-1 rounded-full border border-red-500/30">
                {{ $pendingCount }} Pending
            </span>
        @endif
    </div>

    @if(isset($myTasks) && $myTasks->count() > 0)
    <div class="space-y-3">
        @foreach($myTasks as $task)
        @php
            $priorityColors = ['low'=>'text-gray-400','normal'=>'text-blue-400','high'=>'text-yellow-400','urgent'=>'text-red-400'];
            $typeColors = ['schedule'=>'bg-cyan-500/20 text-cyan-400','request'=>'bg-purple-500/20 text-purple-400','task'=>'bg-gray-700 text-gray-300'];
            $isToday = $task->date && \Carbon\Carbon::parse($task->date)->isToday();
            $isDone = $task->status === 'done';
        @endphp
        <div class="flex items-start justify-between p-4 rounded-xl
            {{ $isToday ? 'border-l-4 border-yellow-400 bg-white/5' : 'bg-white/3' }}
            {{ $isDone ? 'opacity-50' : '' }}">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="text-[10px] px-2 py-0.5 rounded-full {{ $typeColors[$task->type] ?? 'bg-gray-700 text-gray-300' }}">
                        {{ ucfirst($task->type) }}
                    </span>
                    <span class="text-[10px] font-bold {{ $priorityColors[$task->priority] ?? 'text-gray-400' }}">
                        {{ strtoupper($task->priority) }}
                    </span>
                    @if($isToday)
                        <span class="text-[10px] bg-yellow-400/20 text-yellow-400 px-2 py-0.5 rounded-full">TODAY</span>
                    @endif
                </div>
                <p class="font-bold text-white {{ $isDone ? 'line-through' : '' }}">{{ $task->title }}</p>
                @if($task->description)
                    <p class="text-xs text-gray-500 mt-0.5">{{ $task->description }}</p>
                @endif
                @if($task->date)
                    <p class="text-xs text-gray-600 mt-1">
                        {{ \Carbon\Carbon::parse($task->date)->format('D, d M Y') }}
                        @if($task->time_start) · {{ $task->time_start }}{{ $task->time_end ? ' – '.$task->time_end : '' }}@endif
                    </p>
                @endif
            </div>
            <form action="{{ route('admin.tasks.status', $task->id) }}" method="POST" class="ml-4 flex-shrink-0">
                @csrf @method('PATCH')
                <select name="status" onchange="this.form.submit()"
                    class="bg-[#0f172a] text-xs text-white rounded-lg px-3 py-1.5 outline-none border border-gray-700 focus:border-yellow-400">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </form>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 text-gray-600">
        <i class="fa fa-clipboard-list text-4xl mb-3 block"></i>
        <p class="text-sm">No tasks assigned yet.</p>
    </div>
    @endif
</div>

<script>
function setView(v) {
    ['day','week','month'].forEach(b => {
        const btn = document.getElementById('btn-'+b);
        btn.className = v === b
            ? 'px-3 py-1 rounded text-xs font-bold bg-cyan-500 text-black transition'
            : 'px-3 py-1 rounded text-xs font-bold text-gray-400 hover:text-white transition';
    });
}
</script>

@endsection
