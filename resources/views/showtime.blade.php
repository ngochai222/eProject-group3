<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

@include('components.header')

<div class="pt-16">
<div class="grid grid-cols-4 gap-10 px-10 py-10">
    <img src="{{ $movie['image'] }}" class="w-full rounded">

    <div class="col-span-3">
        <h2 class="text-2xl font-bold mb-2">{{ $movie['title'] }}</h2>
        <div class="flex gap-4 text-sm text-gray-400 mb-6">
            <span>🎬 {{ $movie['genre'] }}</span>
            @if(isset($movie['duration']))<span>⏱ {{ $movie['duration'] }}</span>@endif
        </div>

        <!-- Date -->
        <h3 class="mb-2">Select a date</h3>
        <div class="flex gap-3 mb-6">
            @foreach(range(12,17) as $day)
                <div class="bg-yellow-400 text-black px-4 py-3 rounded text-center">
                    <p class="font-bold">{{ $day }}</p>
                    <p>April</p>
                </div>
            @endforeach
        </div>

        <!-- Cinema -->
        <h3 class="mb-2">Select a cinema</h3>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="border border-yellow-400 p-4 rounded">
                <h4 class="font-bold">Grand IMAX Plaza</h4>
                <p class="text-sm text-gray-400">Downtown</p>
                <div class="flex gap-2 mt-2">
                    <span class="bg-red-500 px-2 py-1 text-xs rounded">IMAX</span>
                    <span class="bg-red-500 px-2 py-1 text-xs rounded">2D</span>
                </div>
            </div>

            <div class="border border-yellow-400 p-4 rounded">
                <h4 class="font-bold">Downtown Boutique</h4>
                <p class="text-sm text-gray-400">City Center</p>
                <div class="flex gap-2 mt-2">
                    <span class="bg-red-500 px-2 py-1 text-xs rounded">2D</span>
                </div>
            </div>
        </div>

        <!-- Showtime -->
        <h3 class="mb-2">IMAX 2D</h3>
        <div class="flex gap-4 mb-6">
            <div class="bg-gray-800 px-6 py-4 rounded">
                <p>11:30 AM</p>
                <p class="text-yellow-400">$22.50</p>
            </div>

            <div class="bg-gray-800 px-6 py-4 rounded opacity-50">
                <p>06:00 PM</p>
                <p class="text-red-500">Sold Out</p>
            </div>

            <div class="bg-gray-800 px-6 py-4 rounded">
                <p>07:45 PM</p>
                <p class="text-yellow-400">$22.50</p>
            </div>
        </div>

        <!-- VIP -->
        <h3 class="mb-2">VIP Lounge</h3>
        <div class="flex gap-4 mb-6">
            <div class="bg-gray-800 px-6 py-4 rounded">
                <p>05:30 PM</p>
                <p class="text-yellow-400">$35.00</p>
            </div>

            <div class="bg-gray-800 px-6 py-4 rounded">
                <p>08:00 PM</p>
                <p class="text-yellow-400">$35.00</p>
            </div>
        </div>

        <button class="bg-yellow-400 text-black px-6 py-3 rounded font-bold">
            CHOOSE SEATS
        </button>
    </div>
</div>

</body>
</html>