<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket - {{ $showtime->movie->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

@include('components.header')

<div class="pt-20 pb-16 px-6 md:px-10 max-w-4xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Book Ticket</h1>

    <div class="bg-gray-900 rounded-2xl p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">{{ $showtime->movie->title }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-400">Showtime:</span>
                <span>{{ \Carbon\Carbon::parse($showtime->start_time)->format('M j, Y H:i') }}</span>
            </div>
            <div>
                <span class="text-gray-400">Room:</span>
                <span>{{ $showtime->room->name ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.bookings.store') }}" method="POST" class="bg-gray-900 rounded-2xl p-6">
        @csrf
        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4">Select Seat</h3>
            <div id="seat-map" class="grid grid-cols-10 gap-2 mb-4">
                <!-- Seats will be loaded here -->
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Selected Seat</label>
            <input type="text" id="selected-seat" readonly class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md">
            <input type="hidden" name="seat_id" id="seat-id">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Price</label>
            <input type="number" name="price" step="0.01" class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md" placeholder="Enter price">
        </div>

        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
            Book Ticket
        </button>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadSeats();

    function loadSeats() {
        fetch('/admin/seats/get-seats-by-showtime/{{ $showtime->id }}')
            .then(response => response.json())
            .then(seats => {
                const seatMap = document.getElementById('seat-map');
                seatMap.innerHTML = '';

                seats.forEach(seat => {
                    const seatBtn = document.createElement('button');
                    seatBtn.type = 'button';
                    seatBtn.className = `w-10 h-10 rounded border-2 text-xs font-bold transition ${
                        seat.is_booked ? 'bg-red-600 border-red-600 cursor-not-allowed' : 'bg-gray-700 border-gray-500 hover:bg-gray-600'
                    }`;
                    seatBtn.textContent = seat.seat_number;
                    seatBtn.disabled = seat.is_booked;

                    if (!seat.is_booked) {
                        seatBtn.addEventListener('click', () => selectSeat(seat));
                    }

                    seatMap.appendChild(seatBtn);
                });
            });
    }

    function selectSeat(seat) {
        document.getElementById('selected-seat').value = seat.seat_number;
        document.getElementById('seat-id').value = seat.id;

        // Highlight selected seat
        document.querySelectorAll('#seat-map button').forEach(btn => {
            btn.classList.remove('ring-2', 'ring-blue-500');
        });
        event.target.classList.add('ring-2', 'ring-blue-500');
    }
});
</script>

</body>
</html>