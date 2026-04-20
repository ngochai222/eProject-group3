@extends('admin.layout.layout')

@section('content')

<h2 class="mb-4">🏢 Cinemas Management</h2>

<button class="btn btn-yellow mb-3" onclick="document.getElementById('addForm').classList.toggle('hidden')">
    + Add Cinema
</button>

{{-- Add Form --}}
<div id="addForm" class="hidden card-dark mb-4 p-4">
    <h4 class="mb-3">Add New Cinema</h4>
    <form action="{{ route('admin.cinemas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Cinema Name</label>
            <input type="text" name="cinema_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="cinema_address" class="form-control" required>
        </div>
        <button class="btn btn-warning">Save</button>
    </form>
</div>

{{-- Table --}}
<div class="card-dark">
    <table class="table table-dark table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cinema Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cinemas as $cinema)
            <tr>
                <td>{{ $cinema->cinema_id }}</td>
                <td>{{ $cinema->cinema_name }}</td>
                <td>{{ $cinema->cinema_address }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editCinema({{ $cinema->cinema_id }}, '{{ $cinema->cinema_name }}', '{{ $cinema->cinema_address }}')">Edit</button>
                    <form action="{{ route('admin.cinemas.destroy', $cinema->cinema_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-gray-500">No cinemas found.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $cinemas->links() }}
</div>

{{-- Edit Modal --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
    <div class="bg-[#1f2937] p-6 rounded-xl w-96">
        <h4 class="mb-4">Edit Cinema</h4>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId">
            <div class="mb-3">
                <label>Cinema Name</label>
                <input type="text" id="editName" name="cinema_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" id="editAddress" name="cinema_address" class="form-control" required>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-warning">Update</button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('editModal').classList.add('hidden')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function editCinema(id, name, address) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editAddress').value = address;
    document.getElementById('editForm').action = '/admin/cinemas/' + id;
    document.getElementById('editModal').classList.remove('hidden');
}
</script>

@endsection
