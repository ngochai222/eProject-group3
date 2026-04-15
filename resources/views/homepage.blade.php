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
<body class="min-h-screen flex flex-col">

    <!-- Top App Bar -->
    <header class="fixed top-0 w-full z-50 bg-[#131313]/90 backdrop-blur-md px-4 md:px-6 py-2">
        <div class="flex items-center justify-between gap-4 md:gap-6 h-12 md:h-14">
            <div class="flex items-center gap-3">
                <button class="p-2 hover:bg-white/10 rounded-lg transition md:hidden">
                    <span class="material-icons text-[#E9BCB6]">menu</span>
                </button>
                <h1 class="text-xl font-bold italic text-[#E50914] tracking-tighter whitespace-nowrap">CINEBOOK</h1>
            </div>
            <nav class="hidden md:flex items-center gap-4 flex-1 justify-center">
                <a href="#" class="text-[#E50914] text-xs uppercase tracking-widest font-bold hover:text-white transition">Movies</a>
                <a href="#" class="text-[#E9BCB6]/70 text-xs uppercase tracking-widest font-bold hover:text-white transition">Cinemas</a>
                <a href="#" class="text-[#E9BCB6]/70 text-xs uppercase tracking-widest font-bold hover:text-white transition">Booking</a>
                <a href="#" class="text-[#E9BCB6]/70 text-xs uppercase tracking-widest font-bold hover:text-white transition">Show Time</a>
                <a href="#" class="text-[#E9BCB6]/70 text-xs uppercase tracking-widest font-bold hover:text-white transition">Contact</a>
            </nav>
            <button class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-gray-600 transition">
                <span class="material-icons text-red text-[20px]">confirmation_number</span>
            </button>
            <a href="/login">
                 <button class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-gray-600 transition">
                
                    <span class="material-icons text-white text-[20px]">person</span>
                 </button>
             </a>
        </div>
    </header>

    <main class="flex-1 pt-16 md:pt-18">

    <!-- Section -->
    <section class="relative w-full h-screen md:h-[85vh] flex items-end pt-14 md:pt-0 pb-6 md:pb-12 px-4 md:px-6 overflow-hidden">
        <img 
            src="https://img.pptvhd36.com/thumbor/2025/10/31/news-aba9b15.jpg" 
            class="absolute inset-0 w-full h-full object-cover"
            alt="Takhon: The Cursed Mask"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-[#121212] via-transparent to-transparent"></div>
        
        <div class="relative z-10 w-full max-w-2xl">
            <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-4">
                <span class="text-[#E9BCB6]/80 text-[8px] md:text-[10px] font-bold uppercase tracking-widest">October 31, 2024</span>
            </div>
            
            <h2 class="text-2xl md:text-5xl font-black italic uppercase leading-tight md:leading-[0.9] tracking-tighter mb-4 md:mb-8">
                Takhon:<br>The Cursed Mask
            </h2>

            <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-4">
                <span class="text-white text-[8px] md:text-[10px] font-bold uppercase tracking-widest">Takhon: The Cursed Mask is a visually intriguing 
                    horror film that blends supernatural fear with Thai folklore. Inspired by the traditional Phi Ta Khon festival, the movie builds its story around a cursed mask tied to death, spirits, and ancient beliefs.</span>
            </div>
            
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
                <h3 class="text-xl md:text-3xl font-black italic uppercase tracking-tight">Hot Movies</h3>
            </div>
            <a href="#" class="text-[#E9BCB6] text-[8px] md:text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 hover:text-[#E50914] transition">
                <span class="hidden sm:inline">View All</span>
                <span class="material-icons text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 px-4 md:px-6">
            @foreach($hotMovies as $movie)
            <div class="group cursor-pointer">
                <div class="relative aspect-[3/4] rounded-lg md:rounded-2xl overflow-hidden mb-2 md:mb-4 bg-gray-800">
                    <img
                        src="{{ $movie['image'] }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        alt="{{ $movie['title'] }}"
                        loading="lazy"
                    >
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
        <div class="relative w-full aspect-video md:aspect-auto md:h-64 rounded-2xl md:rounded-3xl overflow-hidden mb-6 flex items-end p-4 md:p-8 group cursor-pointer bg-[#AA8F2E]">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
            <div class="relative z-10">
                <span class="text-[#FFD97E] text-[8px] md:text-[10px] font-bold uppercase tracking-widest mb-1 md:mb-2 block">Dining</span>
                <h4 class="text-white text-lg md:text-3xl font-black italic uppercase tracking-tighter mb-1 md:mb-2">Midnight Feast</h4>
                <p class="text-[#F3E0AA] text-xs md:text-sm max-w-[200px]">Get 50% off on all large popcorn combos
during screenings after 10:00 PM</p>
            </div>
        </div>

        <!-- Membership Pass Card -->
       
    </section>

    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-black text-red px-6 md:px-16 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h2 class="text-xl font-bold tracking-widest mb-4 text-[#E50914]">CINEBOOK</h2>
            <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                Redefining the cinematic experience with premium curation, 
                state-of-the-art technology, and absolute Noir aesthetics.
            </p>
        </div>
        <div>
            <h3 class="text-sm font-bold uppercase tracking-widest mb-4">Contact</h3>
            <p class="text-gray-400 text-sm">+84 566 940 182</p>
            <p class="text-gray-400 text-sm mt-2">
                12 Ly Tu Trong, Ninh Kieu, Can Tho, Viet Nam
            </p>
        </div>
        <div>
            <h3 class="text-sm font-bold uppercase tracking-widest mb-4">Connect</h3>
            <p class="text-gray-400 text-sm hover:text-white cursor-pointer transition">Instagram</p>
            <p class="text-gray-400 text-sm mt-2 hover:text-white cursor-pointer transition">Facebook</p>
        </div>

    </div>
    <div class="mt-10 border-t border-gray-800 pt-6 text-center text-gray-500 text-xs tracking-widest">
        © 2026 CINEBOOK. ALL RIGHTS RESERVED
    </div>
</footer>

</body>
</html>
