@extends('superadmin.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-black text-white">Tasks & Schedule</h2>
        <p class="text-sm text-gray-500 mt-1">Assign tasks, schedules and requests to managers</p>
    </div>
</div>

{{-- CREATE FORM --}}
<div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-6 mb-6">
    <h3 class="font-bold text-white mb-4">Assign New Task</h3>
    <form action="{{ route('superadmin.tasks.store') }}" method="POST" class="grid grid-cols-2 gap-4">
        @csrf

        <div>
            <label class="text-xs text-gray-400 block mb-1">Manager</label>
            <select name="manager_id" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
                <option value="">-- Select Manager --</option>
                @foreach($managers as $m)
                    <option value="{{ $m->customer_id }}">{{ $m->customer_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-xs text-gray-400 block mb-1">Type</label>
            <select name="type" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
                <option value="task">Task</option>
                <option value="schedule">Schedule</option>
                <option value="request">Request</option>
            </select>
        </div>

        <div class="col-span-2">
            <label class="text-xs text-gray-400 block mb-1">Title</label>
            <input type="text" name="title" placeholder="e.g. Check theater 4 cleaning"
                class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
        </div>

        <div class="col-span-2">
            <label class="text-xs text-gray-400 block mb-1">Description</label>
            <textarea name="description" rows="2" placeholder="Details..."
                class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none"></textarea>
        </div>

        <div>
            <label class="text-xs text-gray-400 block mb-1">Date</label>
            <input type="date" name="date" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
        </div>

        <div>
            <label class="text-xs text-gray-400 block mb-1">Priority</label>
            <select name="priority" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
                <option value="low">Low</option>
                <option value="normal" selected>Normal</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
            </select>
        </div>

        <div>
            <label class="text-xs text-gray-400 block mb-1">Start Time</label>
            <input type="time" name="time_start" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
        </div>

        <div>
            <label class="text-xs text-gray-400 block mb-1">End Time</label>
            <input type="time" name="time_end" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
        </div>

        <div class="col-span-2 flex justify-end">
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-6 py-2 rounded-lg transition">
                Assign Task
            </button>
        </div>
    </form>
</div>

{{-- TASKS LIST --}}
<div class="bg-[#0d1117] border border-gray-800 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-800">
        <h3 class="font-bold text-white">All Assigned Tasks</h3>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-600 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Manager</th>
                <th class="px-4 py-3 text-left">Task</th>
                <th class="px-4 py-3 text-center">Type</th>
                <th class="px-4 py-3 text-center">Date</th>
                <th class="px-4 py-3 text-center">Priority</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $t)
            <tr class="border-b border-gray-800/50 hover:bg-white/3 transition">
                <td class="px-5 py-3 font-semibold text-white">{{ $t->manager_name }}</td>
                <td class="px-4 py-3">
                    <p class="text-white">{{ $t->title }}</p>
                    @if($t->description)<p class="text-xs text-gray-500 mt-0.5">{{ Str::limit($t->description, 50) }}</p>@endif
                </td>
                <td class="px-4 py-3 text-center">
                    <span class="text-xs px-2 py-0.5 rounded-full
                        {{ $t->type == 'schedule' ? 'bg-cyan-500/20 text-cyan-400' : ($t->type == 'request' ? 'bg-purple-500/20 text-purple-400' : 'bg-gray-700 text-gray-300') }}">
                        {{ ucfirst($t->type) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center text-gray-400 text-xs">
                    {{ $t->date ? \Carbon\Carbon::parse($t->date)->format('d M Y') : '—' }}
                    @if($t->time_start)<br><span class="text-gray-600">{{ $t->time_start }}{{ $t->time_end ? ' – '.$t->time_end : '' }}</span>@endif
                </td>
                <td class="px-4 py-3 text-center">
                    @php $colors = ['low'=>'text-gray-400','normal'=>'text-blue-400','high'=>'text-yellow-400','urgent'=>'text-red-400']; @endphp
                    <span class="text-xs font-bold {{ $colors[$t->priority] ?? 'text-gray-400' }}">{{ ucfirst($t->priority) }}</span>
                </td>
                <td class="px-4 py-3 text-center">
                    @if($t->status == 'done')
                        <span class="text-xs text-green-400">Done</span>
                    @elseif($t->status == 'in_progress')
                        <span class="text-xs text-yellow-400">In Progress</span>
                    @else
                        <span class="text-xs text-gray-500">Pending</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-center">
                    <form action="{{ route('superadmin.tasks.destroy', $t->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-400 transition" onclick="return confirm('Delete?')">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-5 py-10 text-center text-gray-600">No tasks assigned yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
