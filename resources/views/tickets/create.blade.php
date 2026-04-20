<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Create Ticket</h1>

        <form action="{{ route('admin.tickets.store') }}" method="POST" class="bg-gray-900 rounded-2xl p-6">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Booking</label>
                <select name="booking_id" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
                    <option value="">Select Booking</option>
                    @foreach(\App\Models\Booking::all() as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->customer_name }} - {{ $booking->showtime->movie->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Seat</label>
                <select name="seat_id" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
                    <option value="">Select Seat</option>
                    @foreach(\App\Models\Seat::all() as $seat)
                    <option value="{{ $seat->id }}">{{ $seat->seat_number }} ({{ $seat->room->name }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Price</label>
                <input type="number" name="price" step="0.01" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Ticket Code</label>
                <input type="text" name="ticket_code" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Payment Method</label>
                <input type="text" name="payment_method" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Create Ticket
                </button>
                <a href="{{ route('admin.tickets.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>