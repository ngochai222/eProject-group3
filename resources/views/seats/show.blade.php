<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Seat Details</h1>

        <div class="bg-gray-900 rounded-2xl p-6">
            <div class="mb-4">
                <h2 class="text-xl font-bold">Seat {{ $seat->seat_number }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <span class="text-gray-400">Room:</span>
                    <span>{{ $seat->room->name ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Seat Number:</span>
                    <span>{{ $seat->seat_number }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Row:</span>
                    <span>{{ $seat->row }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Column:</span>
                    <span>{{ $seat->column }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Type:</span>
                    <span class="capitalize">{{ $seat->seat_type }}</span>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-bold mb-4">Booking History</h3>
                @if($seat->tickets->count() > 0)
                <div class="space-y-2">
                    @foreach($seat->tickets as $ticket)
                    <div class="bg-gray-800 p-3 rounded">
                        <p><strong>Movie:</strong> {{ $ticket->booking->showtime->movie->title }}</p>
                        <p><strong>Customer:</strong> {{ $ticket->booking->customer_name }}</p>
                        <p><strong>Showtime:</strong> {{ \Carbon\Carbon::parse($ticket->booking->showtime->start_time)->format('M j, Y H:i') }}</p>
                        <p><strong>Status:</strong> <span class="capitalize {{ $ticket->status == 'confirmed' ? 'text-green-500' : 'text-yellow-500' }}">{{ $ticket->status }}</span></p>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">No booking history for this seat.</p>
                @endif
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.seats.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Back to Seats
                </a>
                <a href="{{ route('admin.seats.edit', $seat->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>