<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Create Employee</h1>

        <form action="{{ route('admin.employees.store') }}" method="POST" class="bg-gray-900 rounded-2xl p-6">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Name</label>
                <input type="text" name="name" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Phone</label>
                <input type="text" name="phone" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Position</label>
                <select name="position" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
                    <option value="staff">Staff</option>
                    <option value="manager">Manager</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Salary</label>
                <input type="number" name="salary" step="0.01" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Room</label>
                <select name="room_id" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
                    <option value="">Select Room</option>
                    @foreach(\App\Models\Room::all() as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Create Employee
                </button>
                <a href="{{ route('admin.employees.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>