<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Edit Seat</h1>

        <form action="{{ route('admin.seats.update', $seat->id) }}" method="POST" class="bg-gray-900 rounded-2xl p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Room</label>
                <select name="room_id" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
                    @foreach(\App\Models\Room::all() as $room)
                    <option value="{{ $room->id }}" {{ $seat->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Seat Number</label>
                <input type="text" name="seat_number" value="{{ $seat->seat_number }}" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Row</label>
                <input type="text" name="row" value="{{ $seat->row }}" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Column</label>
                <input type="number" name="column" value="{{ $seat->column }}" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Seat Type</label>
                <select name="seat_type" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
                    <option value="standard" {{ $seat->seat_type == 'standard' ? 'selected' : '' }}>Standard</option>
                    <option value="vip" {{ $seat->seat_type == 'vip' ? 'selected' : '' }}>VIP</option>
                    <option value="premium" {{ $seat->seat_type == 'premium' ? 'selected' : '' }}>Premium</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Update Seat
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