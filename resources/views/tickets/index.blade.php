<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Tickets Management</h1>
        </div>

        <div class="bg-gray-900 rounded-2xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Seat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->booking->customer_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->seat->seat_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($ticket->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="capitalize {{ $ticket->status == 'confirmed' ? 'text-green-500' : 'text-yellow-500' }}">{{ $ticket->status }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-500 hover:text-blue-400 mr-3">View</a>
                            <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="text-yellow-500 hover:text-yellow-400 mr-3">Edit</a>
                            <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No tickets found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>