<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

@include('components.header')

<div class="pt-20 pb-16 px-6 md:px-10 max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Booking Details</h1>

    <div class="bg-gray-900 rounded-2xl p-6">
        <div class="mb-4">
            <h2 class="text-xl font-bold">{{ $booking->showtime->movie->title }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
            <div>
                <span class="text-gray-400">Customer:</span>
                <span>{{ $booking->customer_name }}</span>
            </div>
            <div>
                <span class="text-gray-400">Email:</span>
                <span>{{ $booking->customer_email }}</span>
            </div>
            <div>
                <span class="text-gray-400">Seat:</span>
                <span>{{ $booking->seat->seat_number }}</span>
            </div>
            <div>
                <span class="text-gray-400">Showtime:</span>
                <span>{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('M j, Y H:i') }}</span>
            </div>
            <div>
                <span class="text-gray-400">Price:</span>
                <span>${{ number_format($booking->price, 2) }}</span>
            </div>
            <div>
                <span class="text-gray-400">Status:</span>
                <span class="capitalize {{ $booking->status == 'confirmed' ? 'text-green-500' : 'text-yellow-500' }}">{{ $booking->status }}</span>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.bookings.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                Back to Bookings
            </a>
            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition" onclick="return confirm('Are you sure?')">
                    Cancel Booking
                </button>
            </form>
        </div>
    </div>

</div>

</body>
</html>