<!DOCTYPE html>

<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cinebook - Select Cinema</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@700;800;900&amp;family=Manrope:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-lowest": "#0e0e0e",
                        "error-container": "#93000a",
                        "on-error-container": "#ffdad6",
                        "surface-dim": "#131313",
                        "on-tertiary": "#003061",
                        "on-tertiary-container": "#f8f9ff",
                        "on-background": "#e2e2e2",
                        "surface-container-highest": "#353535",
                        "error": "#ffb4ab",
                        "secondary-fixed": "#ffdad5",
                        "on-surface": "#e2e2e2",
                        "primary-fixed": "#ffdad5",
                        "outline": "#af8782",
                        "on-primary": "#690003",
                        "surface-container-high": "#2a2a2a",
                        "on-secondary-fixed": "#410001",
                        "on-secondary": "#690003",
                        "on-error": "#690005",
                        "on-primary-container": "#fff7f6",
                        "on-tertiary-fixed": "#001b3c",
                        "surface": "#131313",
                        "primary": "#ffb4aa",
                        "on-secondary-fixed-variant": "#8e1210",
                        "primary-container": "#e50914",
                        "outline-variant": "#5e3f3b",
                        "surface-bright": "#393939",
                        "inverse-surface": "#e2e2e2",
                        "on-primary-fixed-variant": "#930007",
                        "primary-fixed-dim": "#ffb4aa",
                        "surface-variant": "#353535",
                        "surface-container": "#1f1f1f",
                        "secondary": "#ffb4aa",
                        "inverse-primary": "#c0000c",
                        "tertiary": "#a7c8ff",
                        "secondary-fixed-dim": "#ffb4aa",
                        "surface-container-low": "#1b1b1b",
                        "on-secondary-container": "#ff9f93",
                        "on-tertiary-fixed-variant": "#004689",
                        "inverse-on-surface": "#303030",
                        "background": "#131313",
                        "tertiary-fixed": "#d5e3ff",
                        "secondary-container": "#921512",
                        "on-surface-variant": "#e9bcb6",
                        "tertiary-fixed-dim": "#a7c8ff",
                        "on-primary-fixed": "#410001",
                        "surface-tint": "#ffb4aa",
                        "tertiary-container": "#0072d7"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Epilogue"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    }
                }
            }
        }
    </script>
<style>
        body {
            background-color: #131313;
            color: #e2e2e2;
            font-family: 'Manrope', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .cinematic-gradient {
            background: linear-gradient(180deg, rgba(19, 19, 19, 0) 0%, rgba(19, 19, 19, 0.9) 100%);
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface selection:bg-primary-container selection:text-white">
<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-6 py-4 fixed top-0 z-50 backdrop-blur-xl bg-opacity-80 bg-[#131313] dark:bg-[#131313] shadow-[0_20px_40px_rgba(0,0,0,0.4)]">
<div class="flex items-center gap-4">
<button class="p-2 -ml-2 hover:bg-[#393939] transition-colors duration-300 rounded-full active:opacity-80 scale-95 duration-200">
<span class="material-symbols-outlined text-[#E50914]" data-icon="arrow_back">arrow_back</span>
</button>
<h1 class="font-['Epilogue'] tracking-tighter uppercase font-bold text-lg text-[#E50914] dark:text-[#E50914]">SELECT CINEMA</h1>
</div>
<div class="flex items-center gap-2">
<span class="text-[#E50914] font-black italic tracking-tighter text-2xl">Cinebook</span>
</div>
</header>
<main class="pt-24 pb-32 px-6 max-w-5xl mx-auto">
<!-- Search/Filter Section -->
<section class="mb-10 space-y-6">
<div class="relative group">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant opacity-50" data-icon="search">search</span>
<input class="w-full bg-on-primary-container border-none py-4 pl-12 pr-4 rounded-xl text-on-surface-fixed-variant placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-primary-container/40 transition-all font-body" placeholder="Search for cinema name or district..." type="text"/>
</div>
<div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
<button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-primary-container text-white font-semibold text-sm shadow-lg shadow-primary-container/20 border border-primary-container">All Cities</button>
<button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-surface-container-low text-on-surface/70 font-medium text-sm border border-outline-variant/10 hover:border-primary-container/50 transition-colors">Hanoi</button>
<button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-surface-container-low text-on-surface/70 font-medium text-sm border border-outline-variant/10 hover:border-primary-container/50 transition-colors">Ho Chi Minh City</button>
<button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-surface-container-low text-on-surface/70 font-medium text-sm border border-outline-variant/10 hover:border-primary-container/50 transition-colors">Da Nang</button>
<button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-surface-container-low text-on-surface/70 font-medium text-sm border border-outline-variant/10 hover:border-primary-container/50 transition-colors">Hai Phong</button>
</div>
</section>
<!-- Cinema List (Asymmetric Bento-inspired Layout) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Card 1 (Hanoi Highlight) -->
<div class="group relative overflow-hidden rounded-3xl bg-surface-container-low border border-white/5 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-primary-container/10">
<div class="relative h-64 w-full">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="luxury cinema interior with deep red velvet seating and cinematic spotlight lighting in a modern grand theater lobby" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDE33ZEIhZQAV3SHcQzMs_VeHb_hGcSazMvdfjPFMX6n2B0I9JX_kjYygHKm2f2AIT150_4v28n0ERdM6J9-glVU8tRxusiWhZFzNtm9FWIF4uokaxi_cxGzz5VMHQAcfkMwnXhb4hmVKyM0KgOrv6YCCT52KRCIuSN_8vixTyRnQxtAoPLbL5fxgEo4fvCn0ZqKBaEXb0RxkcCT-gFwk0Wt2ZxnbdAbtC_cwMNdAVPqhW6OPv5n-X0cdQ0VQW5OUmBEG0KAVlZ"/>
<div class="absolute inset-0 cinematic-gradient"></div>
<div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
<div class="flex flex-wrap gap-2">
<span class="px-3 py-1 bg-primary-container text-[10px] font-bold tracking-widest text-white rounded-md uppercase">IMAX</span>
<span class="px-3 py-1 bg-surface-bright/80 backdrop-blur-md text-[10px] font-bold tracking-widest text-white rounded-md uppercase">Dolby Atmos</span>
</div>
</div>
</div>
<div class="p-6 space-y-3">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-2xl font-black tracking-tight text-on-surface">Cinebook Hoan Kiem</h3>
<p class="font-body text-sm text-on-surface/60 mt-1 flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="location_on">location_on</span>
                                12 Ly Thai To Street, Hoan Kiem, Hanoi
                            </p>
</div>
<span class="material-symbols-outlined text-primary-container" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<div class="pt-4 flex items-center justify-between">
<span class="text-xs font-bold text-on-surface/40 tracking-widest uppercase">8.4 KM AWAY</span>
<button class="bg-primary-container hover:bg-on-primary-fixed-variant text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg active:scale-95">SELECT</button>
</div>
</div>
</div>
<!-- Card 2 (HCMC Landmark) -->
<div class="group relative overflow-hidden rounded-3xl bg-surface-container-low border border-white/5 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-primary-container/10">
<div class="relative h-64 w-full">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="ultra modern futuristic cinema lobby with neon red accents architectural curves and digital displays in Ho Chi Minh City" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2McJZsKb9PyWLuD6ndDfnIYW7kZFRC1E15ZeeZH-OfU5GWh1Efs7RBnIiEam86viE754aZ52Kr-OJgnig3N8LAordqcjceHexhi3mDop6_9aHE8pGcnioWhfw98k-xY6Zwomk0OIGHH2m__MI0DbtPaxMnnjDVDHL3Ya69YdSjylx4jR3PJSkNpdQ5QbkduQuW8dmaZasCwBsxx7zasm1Z5VfYYqIqf-4NhVHIOKmvNkE1dPT6ijBmRgh5RAdThR_oFrlLht-"/>
<div class="absolute inset-0 cinematic-gradient"></div>
<div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
<div class="flex flex-wrap gap-2">
<span class="px-3 py-1 bg-primary-container text-[10px] font-bold tracking-widest text-white rounded-md uppercase">Gold Class</span>
<span class="px-3 py-1 bg-surface-bright/80 backdrop-blur-md text-[10px] font-bold tracking-widest text-white rounded-md uppercase">4DX</span>
</div>
</div>
</div>
<div class="p-6 space-y-3">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-2xl font-black tracking-tight text-on-surface">Cinebook Landmark 81</h3>
<p class="font-body text-sm text-on-surface/60 mt-1 flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="location_on">location_on</span>
                                B1, Vincom Landmark 81, Binh Thanh, HCMC
                            </p>
</div>
</div>
<div class="pt-4 flex items-center justify-between">
<span class="text-xs font-bold text-on-surface/40 tracking-widest uppercase">2.1 KM AWAY</span>
<button class="bg-primary-container hover:bg-on-primary-fixed-variant text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg active:scale-95">SELECT</button>
</div>
</div>
</div>
<!-- Card 3 (Da Nang Coastal) -->
<div class="group relative overflow-hidden rounded-3xl bg-surface-container-low border border-white/5 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-primary-container/10">
<div class="relative h-64 w-full">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="elegant boutique cinema entrance with vintage movie posters and warm golden ambient lighting in Da Nang city" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBiw8jFASKV1g8EDRUuUldMidz7lPd9aj0gp_uzi92ENygcVC15xWrnnrjJv_HamSk-vqnDR0dUVCWnKKeUmfli6DI6ksZc6F-BCX1Ufv4HeV8Ex8X_U9roh7ZL87UX_xqpmWsFSJZAuGJzHl1uZccsiwlsgtSZMnHDO7qIfmIzQ-sPtrSD-Kko-2I6xO0UUsXONS-VZKr_V36w3AxHdJcBzIWmM0vhzVzrM2fnxg-gYZrMBSdea6L-EO2-mEuaB49NF6NcwEzf"/>
<div class="absolute inset-0 cinematic-gradient"></div>
<div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
<div class="flex flex-wrap gap-2">
<span class="px-3 py-1 bg-primary-container text-[10px] font-bold tracking-widest text-white rounded-md uppercase">Dolby Atmos</span>
</div>
</div>
</div>
<div class="p-6 space-y-3">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-2xl font-black tracking-tight text-on-surface">Cinebook Da Nang Riverside</h3>
<p class="font-body text-sm text-on-surface/60 mt-1 flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="location_on">location_on</span>
                                Bach Dang Street, Hai Chau, Da Nang
                            </p>
</div>
</div>
<div class="pt-4 flex items-center justify-between">
<span class="text-xs font-bold text-on-surface/40 tracking-widest uppercase">15.2 KM AWAY</span>
<button class="bg-primary-container hover:bg-on-primary-fixed-variant text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg active:scale-95">SELECT</button>
</div>
</div>
</div>
<!-- Card 4 (Hanoi Westlake) -->
<div class="group relative overflow-hidden rounded-3xl bg-surface-container-low border border-white/5 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-primary-container/10">
<div class="relative h-64 w-full">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="wide shot of a modern cinematic theater room with plush seating rows and soft red floor lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBh6yz0ZdWrlK7mbXR2GS7-oUgf3jdjzvCIfl9xWEU-R6p2WGzuo9jBG2pYnCfcHkIT909XiK5dhTpxZToNhgRnG0-914fFrz96oAOR9dVGVCkDFuPu4qjxDKXm3paQOrr8-01O2qSFb87o0MplNTDZ3i2nTTPuCs5C-l7EHf8sL-KeYjvW14CCJ7Q23DG0taTHX4bMSqpc6eol8R7x8QhwPL8ZCYZ77GDPaBHTL1mYlltu8LfgG9jtboH5PJLCAtei1PJHARjT"/>
<div class="absolute inset-0 cinematic-gradient"></div>
<div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
<div class="flex flex-wrap gap-2">
<span class="px-3 py-1 bg-primary-container text-[10px] font-bold tracking-widest text-white rounded-md uppercase">IMAX</span>
<span class="px-3 py-1 bg-surface-bright/80 backdrop-blur-md text-[10px] font-bold tracking-widest text-white rounded-md uppercase">Gold Class</span>
</div>
</div>
</div>
<div class="p-6 space-y-3">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-2xl font-black tracking-tight text-on-surface">Cinebook Lotte Westlake</h3>
<p class="font-body text-sm text-on-surface/60 mt-1 flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="location_on">location_on</span>
                                272 Vo Chi Cong, Tay Ho, Hanoi
                            </p>
</div>
</div>
<div class="pt-4 flex items-center justify-between">
<span class="text-xs font-bold text-on-surface/40 tracking-widest uppercase">12.0 KM AWAY</span>
<button class="bg-primary-container hover:bg-on-primary-fixed-variant text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg active:scale-95">SELECT</button>
</div>
</div>
</div>
</div>
</main>
<!-- BottomNavBar -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-6 pt-3 backdrop-blur-2xl border-t border-white/5 bg-[#131313]/90 dark:bg-[#131313]/90 shadow-[0_-10px_30px_rgba(0,0,0,0.5)]">
<a class="flex flex-col items-center justify-center text-[#e2e2e2]/60 hover:text-white transition-all active:scale-90 tap-highlight-none" href="#">
<span class="material-symbols-outlined mb-1" data-icon="movie">movie</span>
<span class="font-['Manrope'] font-medium text-[10px] uppercase tracking-widest">Movies</span>
</a>
<a class="flex flex-col items-center justify-center text-[#E50914] bg-[#E50914]/10 rounded-xl px-4 py-1 active:scale-90 tap-highlight-none" href="#">
<span class="material-symbols-outlined mb-1" data-icon="theater_comedy" style="font-variation-settings: 'FILL' 1;">theater_comedy</span>
<span class="font-['Manrope'] font-medium text-[10px] uppercase tracking-widest">Cinemas</span>
</a>
<a class="flex flex-col items-center justify-center text-[#e2e2e2]/60 hover:text-white transition-all active:scale-90 tap-highlight-none" href="#">
<span class="material-symbols-outlined mb-1" data-icon="confirmation_number">confirmation_number</span>
<span class="font-['Manrope'] font-medium text-[10px] uppercase tracking-widest">Tickets</span>
</a>
<a class="flex flex-col items-center justify-center text-[#e2e2e2]/60 hover:text-white transition-all active:scale-90 tap-highlight-none" href="#">
<span class="material-symbols-outlined mb-1" data-icon="person">person</span>
<span class="font-['Manrope'] font-medium text-[10px] uppercase tracking-widest">Profile</span>
</a>
</nav>
</body></html>