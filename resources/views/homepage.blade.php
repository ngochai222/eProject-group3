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

    @include('components.header')

    <main class="flex-1 pt-16 md:pt-18">

    @if (session('success'))
        <div class="mx-4 mt-20 rounded-2xl border border-green-500/40 bg-green-500/10 px-4 py-3 text-sm text-green-100 shadow-lg shadow-green-500/10 md:mx-6">
            {{ session('success') }}
        </div>
    @endif

    

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

    <!-- Coming Soon Section -->
    <section id="coming-soon" class="mt-10 md:mt-12 px-4 md:px-6">
        <div class="flex justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h3 class="text-xl md:text-3xl font-black italic uppercase tracking-tight">Coming Soon</h3>
            </div>
            <a href="#" class="text-[#E9BCB6] text-[8px] md:text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 hover:text-[#E50914] transition">
                <span class="hidden sm:inline">View All</span>
                <span class="material-icons text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 px-4 md:px-6">
            @foreach($comingSoonMovies as $movie)
            <div class="group cursor-pointer">
                <div class="relative aspect-[3/4] rounded-lg md:rounded-2xl overflow-hidden mb-2 md:mb-4 bg-gray-800">
                    <img
                        src="{{ $movie['image'] }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        alt="{{ $movie['title'] }}"
                        loading="lazy"
                    >
                    <div class="absolute top-2 left-2 bg-[#E50914] text-white text-[9px] font-bold uppercase tracking-widest px-2 py-1 rounded-full">
                        {{ $movie['release_date'] }}
                    </div>
                </div>
                <h4 class="font-bold text-xs md:text-lg leading-tight uppercase mb-1 line-clamp-2">{{ $movie['title'] }}</h4>
                <p class="text-[#E9BCB6]/50 text-[10px] md:text-xs font-bold uppercase tracking-widest line-clamp-1">
                    {{ $movie['genre'] }}
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
    </section>

    </main>

    @include('components.footer')

    <script>
        function closeAlert() {
            document.getElementById('success-alert').style.display = 'none';
        }

        // Auto-hide alert after 5 seconds
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500);
            }
        }, 5000);
    </script>

</body>
</html>
