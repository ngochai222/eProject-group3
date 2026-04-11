<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinebook - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,400;0,700;0,900;1,900&family=Manrope:wght@400;700&family=Material+Icons&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Epilogue', sans-serif; background-color: #121212; color: #fff; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="pb-24">

    <!-- Top App Bar Component -->
    <header class="fixed top-0 w-full z-50 bg-[#131313]/60 backdrop-blur-md h-16 flex justify-between items-center px-6">
        <div class="flex items-center">
            <span class="material-icons text-[#E9BCB6]">menu</span>
            <h1 class="ml-4 text-2xl font-black italic text-[#E50914] tracking-tighter">CINEBOOK</h1>
        </div>
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center overflow-hidden border border-[#5E3F3B]/30">
             <span class="material-icons text-white">person</span>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative w-full h-[85vh] flex items-end pb-12 px-6 overflow-hidden">
        <img src="https://img.pptvhd36.com/thumbor/2025/10/31/news-aba9b15.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Hero">
        <div class="absolute inset-0 bg-gradient-to-t from-[#121212] via-transparent to-transparent"></div>
        
        <div class="relative z-10 w-full">
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-[#E50914] text-white text-[10px] font-bold px-3 py-1 rounded-sm uppercase tracking-wider">Coming Soon</span>
                <span class="text-[#E9BCB6]/80 text-[10px] font-bold uppercase tracking-widest">October 31, 2024</span>
            </div>
            <h2 class="text-5xl font-black italic uppercase leading-[0.9] tracking-tighter mb-8">
                Takhon:<br>The Cursed Mask
            </h2>
            <div class="flex gap-4">
                <button class="flex-1 bg-[#E50914] text-white font-bold py-4 rounded-full flex items-center justify-center gap-2 active:scale-95 transition-all">
                 BUY TICKETS
                </button>
                <button class="flex-1 border border-white/20 text-white font-bold py-4 rounded-full flex items-center justify-center gap-2 active:scale-95 transition-all">
                   <span class="material-icons">play_arrow</span> WATCH TRAILER
                </button>
            </div>
        </div>
    </section>

    <!-- Hot Movies -->
    <section class="mt-12 px-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <span class="text-[#E9BCB6]/60 text-[10px] font-bold uppercase tracking-[0.2em]">Now Showing</span>
                <h3 class="text-3xl font-black italic uppercase tracking-tight">Hot Movies</h3>
            </div>
            <a href="#" class="text-[#E9BCB6] text-[10px] font-bold uppercase tracking-widest flex items-center gap-1">
                View All <span class="material-icons text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="flex gap-4 overflow-x-auto pb-4 -mx-6 px-6 no-scrollbar">
            @foreach($hotMovies as $movie)
            <div class="min-w-[280px] group">
                <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-4">
                    <img src="{{ $movie['image'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $movie['title'] }}">
                    @if($movie['isIMAX'])
                    <span class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white text-[8px] font-bold px-2 py-1 rounded-sm border border-white/10">IMAX</span>
                    @endif
                </div>
                <h4 class="font-bold text-lg leading-tight uppercase mb-1">{{ $movie['title'] }}</h4>
                <p class="text-[#E9BCB6]/40 text-xs font-bold uppercase tracking-widest">
                    {{ $movie['genre'] }} • {{ $movie['duration'] }}
                </p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Exclusive Offers -->
    <section class="mt-16 px-6 mb-12">
        <span class="block text-center text-[#E9BCB6]/40 text-[10px] font-bold uppercase tracking-[0.3em] mb-12">Exclusive Offers</span>
        
        <!-- Dining Offer -->
        <div class="relative w-full aspect-video rounded-3xl overflow-hidden mb-6 flex items-end p-8">
            <img src="https://example.com/cat.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Dining">
            <div class="relative z-10">
                <span class="text-[#E50914] text-[10px] font-bold uppercase tracking-widest mb-1 block">Dining</span>
                <h4 class="text-3xl font-black italic uppercase tracking-tighter mb-2">Midnight Feast</h4>
                <p class="text-[#E9BCB6]/80 text-sm max-w-[200px]">Unlimited popcorn and sodas for all late-night premieres.</p>
            </div>
        </div>

        <!-- Membership Pass -->
        <div class="bg-[#E50914] rounded-3xl p-8 relative overflow-hidden">
            <div class="flex justify-between items-start mb-12">
                <span class="material-icons text-white/30 text-4xl">confirmation_number</span>
                <div class="text-right">
                    <span class="text-white/60 text-[8px] font-bold uppercase tracking-widest block mb-1">Member Pass</span>
                    <span class="text-white font-black italic uppercase text-xl">Noir Premiere</span>
                </div>
            </div>
            <h4 class="text-5xl font-black italic uppercase tracking-tighter text-white mb-6">Pass</h4>
            <button class="bg-white text-[#E50914] text-[10px] font-black uppercase tracking-widest px-8 py-3 rounded-full">Upgrade Now</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full px-8 py-12 flex flex-col items-center gap-6 mb-20 border-t border-[#5E3F3B]/10">
        <span class="text-[#E50914] font-black tracking-widest text-xs uppercase">CINEBOOK</span>
        <div class="flex gap-6">
            <a href="#" class="text-[#E9BCB6]/40 text-[10px] font-bold uppercase tracking-widest">Privacy</a>
            <a href="#" class="text-[#E9BCB6]/40 text-[10px] font-bold uppercase tracking-widest">Terms</a>
            <a href="#" class="text-[#E9BCB6]/40 text-[10px] font-bold uppercase tracking-widest">Support</a>
            <a href="#" class="text-[#E9BCB6]/40 text-[10px] font-bold uppercase tracking-widest">Careers</a>
        </div>
        <p class="text-[#E9BCB6]/40 text-[8px] uppercase tracking-widest">© 2024 CINEBOOK. THE DIGITAL AUTEUR.</p>
    </footer>

    <!-- Bottom Nav Bar -->
    <nav class="fixed bottom-0 w-full z-50 bg-[#131313]/80 backdrop-blur-xl h-20 px-4 pb-2 flex justify-around items-center rounded-t-3xl border-t border-[#5E3F3B]/15 shadow-[0_-10px_40px_rgba(229,9,20,0.08)]">
        <div class="flex flex-col items-center justify-center text-[#E50914] scale-110">
            <span class="material-icons">movie</span>
            <span class="font-['Manrope'] text-[10px] uppercase tracking-widest font-bold mt-1">Movies</span>
        </div>
        <div class="flex flex-col items-center justify-center text-[#E9BCB6]/60">
            <span class="material-icons">theater_comedy</span>
            <span class="font-['Manrope'] text-[10px] uppercase tracking-widest font-bold mt-1">Cinemas</span>
        </div>
        <div class="flex flex-col items-center justify-center text-[#E9BCB6]/60">
            <span class="material-icons">confirmation_number</span>
            <span class="font-['Manrope'] text-[10px] uppercase tracking-widest font-bold mt-1">Tickets</span>
        </div>
        <div class="flex flex-col items-center justify-center text-[#E9BCB6]/60">
            <span class="material-icons">person</span>
            <span class="font-['Manrope'] text-[10px] uppercase tracking-widest font-bold mt-1">Profile</span>
        </div>
    </nav>

</body>
</html>