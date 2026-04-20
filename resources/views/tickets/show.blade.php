<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Ticket Details</h1>

        <div class="bg-gray-900 rounded-2xl p-6">
            <div class="mb-4">
                <h2 class="text-xl font-bold">Ticket #{{ $ticket->id }}</h2>
                <p class="text-gray-400">Code: {{ $ticket->ticket_code }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <span class="text-gray-400">Customer:</span>
                    <span>{{ $ticket->booking->customer_name }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Email:</span>
                    <span>{{ $ticket->booking->customer_email }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Movie:</span>
                    <span>{{ $ticket->booking->showtime->movie->title }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Seat:</span>
                    <span>{{ $ticket->seat->seat_number }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Showtime:</span>
                    <span>{{ \Carbon\Carbon::parse($ticket->booking->showtime->start_time)->format('M j, Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Price:</span>
                    <span>${{ number_format($ticket->price, 2) }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Status:</span>
                    <span class="capitalize {{ $ticket->status == 'confirmed' ? 'text-green-500' : 'text-yellow-500' }}">{{ $ticket->status }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Payment Method:</span>
                    <span>{{ $ticket->payment_method ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Booking Time:</span>
                    <span>{{ \Carbon\Carbon::parse($ticket->booking_time)->format('M j, Y H:i') }}</span>
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.tickets.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Back to Tickets
                </a>
                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>