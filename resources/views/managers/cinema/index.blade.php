@extends('managers.layout.layout')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-2">
    <div>
        <h2 class="text-2xl font-bold text-white">Cinemas</h2>

    </div>
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-[#11161c] rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Cinemas</p>
        <h2 class="text-3xl font-black text-yellow-400">{{ str_pad($cinemas->total(), 2, '0', STR_PAD_LEFT) }}</h2>
    </div>
    <div class="bg-[#11161c] rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Active Locations</p>
        <h2 class="text-3xl font-black text-cyan-400">{{ str_pad($cinemas->total(), 2, '0', STR_PAD_LEFT) }}</h2>
    </div>
    <div class="bg-[#11161c] rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Screens</p>
        <h2 class="text-3xl font-black text-white">142</h2>
    </div>
</div>

{{-- ADD BUTTON --}}
<a href="{{ route('admin.cinemas.create') }}"
   class="inline-flex items-center gap-2 bg-yellow-400 text-black font-bold px-5 py-2 rounded-lg hover:bg-yellow-300 transition mb-6">
    <i class="fa fa-plus-circle"></i> Add New Cinema
</a>

{{-- TABLE CARD --}}
<div class="bg-[#11161c] rounded-2xl overflow-hidden">

    {{-- SEARCH --}}
    <div class="flex gap-3 p-4 border-b border-gray-800">
        <div class="relative flex-1 max-w-sm">
            <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <input type="text" id="searchInput" placeholder="Search by title, genre, or director..."
                class="w-full bg-[#0f172a] text-white text-sm pl-8 pr-4 py-2 rounded-lg border border-gray-700 focus:border-yellow-400 outline-none">
        </div>
        <div class="relative">
            <i class="fa fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <select class="bg-[#0f172a] text-gray-300 text-sm pl-8 pr-4 py-2 rounded-lg border border-gray-700 outline-none appearance-none">
                <option>Genre: All</option>
            </select>
        </div>
        <div class="relative">
            <i class="fa fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <select class="bg-[#0f172a] text-gray-300 text-sm pl-8 pr-4 py-2 rounded-lg border border-gray-700 outline-none appearance-none">
                <option>Release Year</option>
            </select>
        </div>
    </div>

    {{-- TABLE --}}
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Cinema</th>
                <th class="px-4 py-3 text-center">Address</th>
                <th class="px-4 py-3 text-center">Rooms</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cinemas as $cinema)
            <tr class="cinema-row border-b border-gray-800/50 hover:bg-white/5 transition"
                data-name="{{ strtolower($cinema->cinema_name) }}">
                <td class="px-5 py-3">
                    <div class="flex items-center gap-3">
                        @if($cinema->cinema_image)
                            <img src="{{ asset('uploads/'.$cinema->cinema_image) }}"
                                 class="w-10 h-10 rounded object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 bg-yellow-400 rounded flex-shrink-0 flex items-center justify-center">
                                <i class="fa fa-building text-black text-xs"></i>
                            </div>
                        @endif
                        <span class="font-semibold text-white uppercase">{{ $cinema->cinema_name }}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-center text-gray-400 text-xs">{{ $cinema->cinema_address }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="font-bold text-white">{{ $cinema->room_count }}</span>
                    <span class="text-gray-500 text-xs"> rooms</span>
                </td>
                <td class="px-4 py-3 text-center">
                    <span class="inline-flex items-center gap-1 text-xs text-green-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Active
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-4">
                        <a href="{{ route('admin.cinemas.edit', $cinema->cinema_id) }}"
                            class="text-gray-400 hover:text-yellow-400 transition" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.cinemas.destroy', $cinema->cinema_id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-400 transition"
                                onclick="return confirm('Delete this cinema?')" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="px-5 py-10 text-center text-gray-500">No cinemas found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="flex justify-between items-center px-5 py-4 border-t border-gray-800 text-sm text-gray-500">
        <p>Showing {{ $cinemas->firstItem() }} to {{ $cinemas->lastItem() }} of {{ $cinemas->total() }} cinemas</p>
        <div class="flex gap-1">
            @for($p = 1; $p <= $cinemas->lastPage(); $p++)
                <a href="{{ $cinemas->url($p) }}"
                   class="w-8 h-8 flex items-center justify-center rounded text-xs
                   {{ $p == $cinemas->currentPage() ? 'bg-yellow-400 text-black font-bold' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                    {{ $p }}
                </a>
            @endfor
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
    <div class="bg-[#1f2937] p-6 rounded-xl w-96">
        <h4 class="font-bold text-white mb-4">Edit Cinema</h4>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="text-sm text-gray-400">Cinema Name</label>
                <input type="text" id="editName" name="cinema_name"
                    class="w-full mt-1 px-4 py-2 bg-black rounded text-white border border-gray-700 outline-none" required>
            </div>
            <div class="mb-3">
                <label class="text-sm text-gray-400">Address</label>
                <input type="text" id="editAddress" name="cinema_address"
                    class="w-full mt-1 px-4 py-2 bg-black rounded text-white border border-gray-700 outline-none">
            </div>
            <div class="mb-4">
                <label class="text-sm text-gray-400">Image (leave empty to keep current)</label>
                <input type="file" name="cinema_image" accept="image/*"
                    class="w-full mt-1 text-sm text-gray-400 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-yellow-400 file:text-black">
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-700 rounded text-white hover:bg-gray-600 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-yellow-400 text-black rounded font-semibold hover:bg-yellow-300 transition">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function editCinema(id, name, address) {
    document.getElementById('editName').value = name;
    document.getElementById('editAddress').value = address;
    document.getElementById('editForm').action = '/admin/cinemas/' + id;
    document.getElementById('editModal').classList.remove('hidden');
}

document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.cinema-row').forEach(row => {
        row.style.display = row.dataset.name.includes(q) ? '' : 'none';
    });
});
</script>

@endsection


