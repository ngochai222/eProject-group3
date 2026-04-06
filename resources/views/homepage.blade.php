<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinebook - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,400;0,700;0,900;1,900&family=Manrope:wght@400;700&family=Material+Icons&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #E50914;
            --color-dark: #121212;
            --color-accent: #E9BCB6;
            --color-border: #5E3F3B;
        }
        
        * { box-sizing: border-box; }
        
        body {
            font-family: 'Epilogue', sans-serif;
            background-color: var(--color-dark);
            color: #fff;
            overflow-x: hidden;
        }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Smooth transitions */
        button { transition: all 0.3s ease; }
        button:active { transform: scale(0.95); }
        button:disabled { opacity: 0.6; cursor: not-allowed; }
        
        /* Focus states for accessibility */
        button:focus, a:focus { outline: 2px solid var(--color-accent); outline-offset: 2px; }
    </style>
</head>
<body class="pb-32 md:pb-24">

    <!-- Top App Bar -->
    <header class="fixed top-0 w-full z-50 bg-[#131313]/60 backdrop-blur-md h-14 md:h-16 flex justify-between items-center px-4 md:px-6">
        <div class="flex items-center gap-2 md:gap-4">
            <button class="p-2 hover:bg-white/10 rounded-lg transition md:hidden">
                <span class="material-icons text-[#E9BCB6]">menu</span>
            </button>
            <h1 class="text-lg md:text-2xl font-black italic text-[#E50914] tracking-tighter whitespace-nowrap">CINEBOOK</h1>
        </div>
        <button class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-gray-600 transition">
            <span class="material-icons text-white text-[20px]">person</span>
        </button>
    </header>

    <!-- Hero Section -->
    <section class="relative w-full h-screen md:h-[85vh] flex items-end pt-14 md:pt-0 pb-6 md:pb-12 px-4 md:px-6 overflow-hidden">
        <img 
            src="https://img.pptvhd36.com/thumbor/2025/10/31/news-aba9b15.jpg" 
            class="absolute inset-0 w-full h-full object-cover"
            alt="Takhon: The Cursed Mask"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-[#121212] via-transparent to-transparent"></div>
        
        <div class="relative z-10 w-full max-w-2xl">
            <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-4">
                <span class="bg-[#E50914] text-white text-[8px] md:text-[10px] font-bold px-2 md:px-3 py-1 rounded uppercase tracking-wider">Coming Soon</span>
                <span class="text-[#E9BCB6]/80 text-[8px] md:text-[10px] font-bold uppercase tracking-widest">October 31, 2024</span>
            </div>
            
            <h2 class="text-2xl md:text-5xl font-black italic uppercase leading-tight md:leading-[0.9] tracking-tighter mb-4 md:mb-8">
                Takhon:<br>The Cursed Mask
            </h2>
            
            <div class="grid grid-cols-2 gap-2 md:flex md:gap-4">
                <button class="bg-[#E50914] text-white font-bold py-2.5 md:py-4 px-3 md:px-6 rounded-full flex items-center justify-center gap-1 md:gap-2 text-xs md:text-sm hover:bg-red-600 active:scale-95 transition-all">
                    <span class="material-icons text-base md:text-lg">local_movies</span>
                    <span class="hidden sm:inline">BUY TICKETS</span>
                    <span class="sm:hidden">BUY</span>
                </button>
                <button class="border border-white/30 text-white font-bold py-2.5 md:py-4 px-3 md:px-6 rounded-full flex items-center justify-center gap-1 md:gap-2 text-xs md:text-sm hover:bg-white/10 active:scale-95 transition-all">
                    <span class="material-icons text-base md:text-lg">play_arrow</span>
                    <span class="hidden sm:inline">TRAILER</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Hot Movies Section -->
    <section class="mt-10 md:mt-12 px-4 md:px-6">
        <div class="flex justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <span class="text-[#E9BCB6]/60 text-[8px] md:text-[10px] font-bold uppercase tracking-[0.2em] block mb-1">Now Showing</span>
                <h3 class="text-xl md:text-3xl font-black italic uppercase tracking-tight">Hot Movies</h3>
            </div>
            <a href="#" class="text-[#E9BCB6] text-[8px] md:text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 hover:text-[#E50914] transition">
                <span class="hidden sm:inline">View All</span>
                <span class="material-icons text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="flex gap-3 md:gap-4 overflow-x-auto pb-4 -mx-4 md:-mx-6 px-4 md:px-6 no-scrollbar">
            @foreach($hotMovies as $movie)
            <div class="min-w-[140px] md:min-w-[280px] group cursor-pointer flex-shrink-0">
                <div class="relative aspect-[3/4] rounded-lg md:rounded-2xl overflow-hidden mb-2 md:mb-4 bg-gray-800">
                    <img 
                        src="{{ $movie['image'] }}" 
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        alt="{{ $movie['title'] }}"
                        loading="lazy"
                    >
                    @if($movie['isIMAX'])
                    <span class="absolute top-2 md:top-4 right-2 md:right-4 bg-black/70 backdrop-blur-md text-white text-[7px] md:text-[8px] font-bold px-1.5 md:px-2 py-0.5 md:py-1 rounded border border-white/20">IMAX</span>
                    @endif
                </div>
                <h4 class="font-bold text-xs md:text-lg leading-tight uppercase mb-1 line-clamp-2">{{ $movie['title'] }}</h4>
                <p class="text-[#E9BCB6]/50 text-[10px] md:text-xs font-bold uppercase tracking-widest line-clamp-1">
                    {{ $movie['genre'] }} • {{ $movie['duration'] }}
                </p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Exclusive Offers Section -->
    <section class="mt-12 md:mt-16 px-4 md:px-6 mb-8 md:mb-12">
        <span class="block text-center text-[#E9BCB6]/40 text-[8px] md:text-[10px] font-bold uppercase tracking-[0.3em] mb-8 md:mb-12">Exclusive Offers</span>
        
        <!-- Dining Offer Card -->
        <div class="relative w-full aspect-video md:aspect-auto md:h-64 rounded-2xl md:rounded-3xl overflow-hidden mb-6 flex items-end p-4 md:p-8 group cursor-pointer">
            <img 
                src="https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=800&h=450&fit=crop" 
                class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-70 transition-opacity duration-300"
                alt="Midnight Feast Dining Offer"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-[#121212] via-transparent to-transparent"></div>
            <div class="relative z-10">
                <span class="text-[#E50914] text-[8px] md:text-[10px] font-bold uppercase tracking-widest mb-1 md:mb-2 block">Dining</span>
                <h4 class="text-lg md:text-3xl font-black italic uppercase tracking-tighter mb-1 md:mb-2">Midnight Feast</h4>
                <p class="text-[#E9BCB6]/80 text-xs md:text-sm max-w-[200px]">Unlimited popcorn & sodas for late-night premieres.</p>
            </div>
        </div>

        <!-- Membership Pass Card -->
        <div class="bg-[#E50914] rounded-2xl md:rounded-3xl p-6 md:p-8 relative overflow-hidden">
            <div class="flex justify-between items-start mb-6 md:mb-12">
                <span class="material-icons text-white/30 text-3xl md:text-4xl">confirmation_number</span>
                <div class="text-right">
                    <span class="text-white/70 text-[7px] md:text-[8px] font-bold uppercase tracking-widest block mb-1">Member Pass</span>
                    <span class="text-white font-black italic uppercase text-sm md:text-xl">Noir Premiere</span>
                </div>
            </div>
            <h4 class="text-4xl md:text-5xl font-black italic uppercase tracking-tighter text-white mb-4 md:mb-6">Pass</h4>
            <button class="bg-white text-[#E50914] text-[8px] md:text-[10px] font-black uppercase tracking-widest px-6 md:px-8 py-2 md:py-3 rounded-full hover:bg-gray-100 active:scale-95 transition-all">
                Upgrade Now
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full px-4 md:px-8 py-8 md:py-12 flex flex-col items-center gap-4 md:gap-6 border-t border-[#5E3F3B]/10">
        <span class="text-[#E50914] font-black tracking-widest text-[10px] md:text-xs uppercase">CINEBOOK</span>
        <div class="flex gap-4 md:gap-6 text-center flex-wrap justify-center">
            <a href="#" class="text-[#E9BCB6]/50 text-[8px] md:text-[10px] font-bold uppercase tracking-widest hover:text-[#E9BCB6] transition">Privacy</a>
            <a href="#" class="text-[#E9BCB6]/50 text-[8px] md:text-[10px] font-bold uppercase tracking-widest hover:text-[#E9BCB6] transition">Terms</a>
            <a href="#" class="text-[#E9BCB6]/50 text-[8px] md:text-[10px] font-bold uppercase tracking-widest hover:text-[#E9BCB6] transition">Support</a>
            <a href="#" class="text-[#E9BCB6]/50 text-[8px] md:text-[10px] font-bold uppercase tracking-widest hover:text-[#E9BCB6] transition">Careers</a>
        </div>
        <p class="text-[#E9BCB6]/40 text-[7px] md:text-[8px] uppercase tracking-widest text-center">© 2024 CINEBOOK. THE DIGITAL AUTEUR.</p>
    </footer>

    <!-- Bottom Nav Bar (Mobile) -->
    <nav class="fixed bottom-0 w-full z-50 bg-[#131313]/90 backdrop-blur-xl h-20 px-2 pb-2 flex justify-around items-center rounded-t-3xl border-t border-[#5E3F3B]/20 shadow-[0_-10px_40px_rgba(229,9,20,0.1)] md:hidden">
        <button class="flex flex-col items-center justify-center text-[#E50914] hover:scale-110 transition">
            <span class="material-icons">movie</span>
            <span class="font-['Manrope'] text-[9px] uppercase tracking-widest font-bold mt-0.5">Movies</span>
        </button>
        <button class="flex flex-col items-center justify-center text-[#E9BCB6]/60 hover:text-[#E9BCB6] transition">
            <span class="material-icons">theater_comedy</span>
            <span class="font-['Manrope'] text-[9px] uppercase tracking-widest font-bold mt-0.5">Cinemas</span>
        </button>
        <button class="flex flex-col items-center justify-center text-[#E9BCB6]/60 hover:text-[#E9BCB6] transition">
            <span class="material-icons">confirmation_number</span>
            <span class="font-['Manrope'] text-[9px] uppercase tracking-widest font-bold mt-0.5">Tickets</span>
        </button>
        <button class="flex flex-col items-center justify-center text-[#E9BCB6]/60 hover:text-[#E9BCB6] transition">
            <span class="material-icons">person</span>
            <span class="font-['Manrope'] text-[9px] uppercase tracking-widest font-bold mt-0.5">Profile</span>
        </button>
    </nav>

</body>
</html>
