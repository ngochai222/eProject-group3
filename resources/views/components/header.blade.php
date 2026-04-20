<!-- Top App Bar -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<header class="fixed top-0 w-full z-50 bg-[#131313]/90 backdrop-blur-md px-4 md:px-6 py-2">
    <div class="flex items-center justify-between gap-4 md:gap-6 h-12 md:h-14">
        <div class="flex items-center gap-3">
            <button class="p-2 hover:bg-white/10 rounded-lg transition md:hidden">
                <span class="material-icons text-[#E9BCB6]">menu</span>
            </button>
            <h1 class="text-xl font-bold italic text-[#E50914] tracking-tighter whitespace-nowrap">CINEBOOK</h1>
        </div>

        <nav class="hidden md:flex items-center gap-4 flex-1 justify-center">
            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'text-[#E50914]' : 'text-[#E9BCB6]/70 hover:text-white' }} text-xs uppercase tracking-widest font-bold transition">
                Movies
            </a>
            <a href="{{ route('cinema') }}"
               class="{{ request()->routeIs('cinema') ? 'text-[#E50914]' : 'text-[#E9BCB6]/70 hover:text-white' }} text-xs uppercase tracking-widest font-bold transition">
                Cinemas
            </a>
            <a href="{{ route('coming-soon') }}"
               class="{{ request()->routeIs('coming-soon') ? 'text-[#E50914]' : 'text-[#E9BCB6]/70 hover:text-white' }} text-xs uppercase tracking-widest font-bold transition">
                Coming Soon
            </a>
            <a href="{{ route('showtime') }}"
               class="{{ request()->routeIs('showtime') ? 'text-[#E50914]' : 'text-[#E9BCB6]/70 hover:text-white' }} text-xs uppercase tracking-widest font-bold transition">
                Show Times  
            </a>
            <a href="#"
               class="{{ request()->routeIs('contact') ? 'text-[#E50914]' : 'text-[#E9BCB6]/70 hover:text-white' }} text-xs uppercase tracking-widest font-bold transition">
                Contact
            </a>
        </nav>

        <button class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-gray-600 transition">
            <span class="material-icons text-white text-[20px]">confirmation_number</span>
        </button>

        @if(auth()->guard('customer')->check())
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-300">{{ auth()->guard('customer')->user()->customer_name }}</span>
                <a href="{{ route('profile') }}">
                    <button class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-gray-600 transition">
                        <span class="material-icons text-white text-[20px]">person</span>
                    </button>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-red-600 transition">
                        <span class="material-icons text-white text-[20px]">logout</span>
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}">
                <button class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center border border-[#5E3F3B]/30 hover:bg-gray-600 transition">
                    <span class="material-icons text-white text-[20px]">person</span>
                </button>
            </a>
        @endif
    </div>
</header>
