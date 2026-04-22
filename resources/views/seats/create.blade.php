<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Seat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Create Seat</h1>

        <form action="{{ route('admin.seats.store') }}" method="POST" class="bg-gray-900 rounded-2xl p-6">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Room</label>
                <select name="room_id" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
                    <option value="">Select Room</option>
                    @foreach(\App\Models\Room::all() as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Seat Number</label>
                <input type="text" name="seat_number" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Row</label>
                <input type="text" name="row" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Column</label>
                <input type="number" name="column" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Seat Type</label>
                <select name="seat_type" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
                    <option value="standard">Standard</option>
                    <option value="vip">VIP</option>
                    <option value="premium">Premium</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Create Seat
                </button>
                <a href="{{ route('admin.seats.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>