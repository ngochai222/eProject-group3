<!DOCTYPE html><html class="dark" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Cinebook Admin - Customer Accounts</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@700;800;900&amp;family=Manrope:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary": "#003061",
                        "on-error-container": "#ffdad6",
                        "surface-bright": "#393939",
                        "on-primary-container": "#fff7f6",
                        "surface-container-high": "#2a2a2a",
                        "on-surface": "#e2e2e2",
                        "surface-dim": "#131313",
                        "surface-container": "#1f1f1f",
                        "surface-container-low": "#1b1b1b",
                        "outline": "#af8782",
                        "on-secondary": "#690003",
                        "tertiary": "#a7c8ff",
                        "secondary": "#ffb4aa",
                        "tertiary-fixed": "#d5e3ff",
                        "on-primary-fixed": "#410001",
                        "on-primary": "#690003",
                        "surface-tint": "#ffb4aa",
                        "surface": "#131313",
                        "inverse-surface": "#e2e2e2",
                        "secondary-container": "#921512",
                        "primary-fixed": "#ffdad5",
                        "on-background": "#e2e2e2",
                        "primary-container": "#e50914",
                        "inverse-on-surface": "#303030",
                        "secondary-fixed": "#ffdad5",
                        "on-secondary-container": "#ff9f93",
                        "surface-variant": "#353535",
                        "tertiary-container": "#0072d7",
                        "on-tertiary-fixed-variant": "#004689",
                        "on-tertiary-fixed": "#001b3c",
                        "on-error": "#690005",
                        "on-secondary-fixed": "#410001",
                        "inverse-primary": "#c0000c",
                        "background": "#131313",
                        "on-secondary-fixed-variant": "#8e1210",
                        "surface-container-highest": "#353535",
                        "primary": "#ffb4aa",
                        "surface-container-lowest": "#0e0e0e",
                        "primary-fixed-dim": "#ffb4aa",
                        "error": "#ffb4ab",
                        "tertiary-fixed-dim": "#a7c8ff",
                        "on-tertiary-container": "#f8f9ff",
                        "on-surface-variant": "#e9bcb6",
                        "secondary-fixed-dim": "#ffb4aa",
                        "outline-variant": "#5e3f3b",
                        "on-primary-fixed-variant": "#930007",
                        "error-container": "#93000a"
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
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Manrope', sans-serif; }
        h1, h2, h3, .headline { font-family: 'Epilogue', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface selection:bg-primary-container selection:text-white">
<!-- Sidebar Navigation Shell -->
<aside class="h-screen w-64 fixed left-0 top-0 overflow-y-auto bg-[#131313] shadow-[30px_0_60px_-15px_rgba(0,0,0,0.5)] flex flex-col border-r border-white/5 z-50">
<div class="p-8">
<h1 class="text-2xl font-black text-[#E50914] tracking-tight uppercase font-['Epilogue']" style="">Cinebook Admin</h1>
<p class="text-[10px] text-on-surface-variant/40 tracking-[0.2em] uppercase mt-1" style=""><br></p>
</div>
<nav class="flex-1 px-4 space-y-2">
<a class="flex items-center gap-3 px-4 py-3 text-[#e2e2e2]/60 hover:text-[#e2e2e2] transition-colors hover:bg-white/5 hover:backdrop-blur-xl rounded-lg" href="#" style="">
<span class="material-symbols-outlined" data-icon="dashboard" style="">dashboard</span>
<span class="font-['Epilogue'] tracking-tighter uppercase font-bold text-sm" style="">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-[#e2e2e2]/60 hover:text-[#e2e2e2] transition-colors hover:bg-white/5 hover:backdrop-blur-xl rounded-lg" href="#" style="">
<span class="material-symbols-outlined" data-icon="movie" style="">movie</span>
<span class="font-['Epilogue'] tracking-tighter uppercase font-bold text-sm" style="">Movie Management</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-[#e2e2e2]/60 hover:text-[#e2e2e2] transition-colors hover:bg-white/5 hover:backdrop-blur-xl rounded-lg" href="#" style="">
<span class="material-symbols-outlined" data-icon="schedule" style="">schedule</span>
<span class="font-['Epilogue'] tracking-tighter uppercase font-bold text-sm" style="">Showtimes</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-[#E50914] bg-white/5 border-r-4 border-[#E50914] transition-all" href="#" style="">
<span class="material-symbols-outlined" data-icon="group" style="">group</span>
<span class="font-['Epilogue'] tracking-tighter uppercase font-bold text-sm" style="">Customer Accounts</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-[#e2e2e2]/60 hover:text-[#e2e2e2] transition-colors hover:bg-white/5 hover:backdrop-blur-xl rounded-lg" href="#" style="">
<span class="material-symbols-outlined" data-icon="analytics" style="">analytics</span>
<span class="font-['Epilogue'] tracking-tighter uppercase font-bold text-sm" style="">Analytics</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-[#e2e2e2]/60 hover:text-[#e2e2e2] transition-colors hover:bg-white/5 hover:backdrop-blur-xl rounded-lg" href="#" style="">
<span class="material-symbols-outlined" data-icon="settings" style="">settings</span>
<span class="font-['Epilogue'] tracking-tighter uppercase font-bold text-sm" style="">Settings</span>
</a>
</nav>
<div class="p-6 mt-auto">
<button class="w-full bg-primary-container text-on-primary-container py-3 px-4 rounded-lg font-['Epilogue'] font-bold text-xs uppercase tracking-widest hover:brightness-125 transition-all active:scale-95" style=""></button>
<div class="mt-8 flex items-center gap-3 pt-6 border-t border-white/5">
<img alt="Cinebook Admin Avatar" class="w-10 h-10 rounded-full border border-primary/20" data-alt="professional headshot of a male administrative manager in a dark suit against a cinematic dark studio background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGcIFW1ZiSk4OWCKbclBnGWiLw1_SCMRBjplrfrsmdAe7hcecC0W8vrGordECD1jq3u7OSOyJ6YgZof6CE-QndGsuOxecut04bB5atPufs4etziKUgdHV_h32enP-WsDSbURpo7_vTmFnoU0-5d45bgzIIoBPtS4QYR0rJsKNmCGxqgfzZ81H_XiJKS3PkofYv0Wyn4JpKbqUFW50pOwgyWlUPYf027N7gB1Wvw45k62PC2cIyXljr98l3F629gUV8aFBGM15p" style="">
<div>
<p class="text-xs font-bold text-on-surface" style="">Alex Rivera</p>
<p class="text-[10px] text-on-surface-variant/60" style="">System Admin</p>
</div>
</div>
</div>
</aside>
<!-- Top Navigation Bar Shell -->
<header class="fixed top-0 right-0 left-64 h-16 bg-[#131313]/80 backdrop-blur-3xl flex items-center justify-between px-8 z-40">
<div class="flex-1 max-w-xl">
<div class="relative group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40" data-icon="search" style="">search</span>
<input class="w-full bg-surface-container-highest/30 border-none rounded-full py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary-container/40 transition-all placeholder:text-on-surface-variant/30" placeholder="Search accounts, transactions, or movies..." type="text">
</div>
</div>
<div class="flex items-center gap-6 text-[#e2e2e2]">
<button class="hover:opacity-80 transition-opacity relative" style="">
<span class="material-symbols-outlined" data-icon="notifications" style="">notifications</span>
<span class="absolute top-0 right-0 w-2 h-2 bg-primary-container rounded-full"></span>
</button>
<button class="hover:opacity-80 transition-opacity" style="">
<span class="material-symbols-outlined" data-icon="account_circle" style="">account_circle</span>
</button>
</div>
</header>
<!-- Main Content Area -->
<main class="ml-64 pt-24 pb-12 px-8 min-h-screen bg-surface-container-lowest">
<div class="flex gap-8">
<!-- Left Side: User Table -->
<div class="flex-1">
<div class="flex items-end justify-between mb-8">
<div>
<h2 class="text-4xl font-black font-['Epilogue'] tracking-tighter text-on-surface" style="">Customer Accounts</h2>
<p class="text-on-surface-variant/60 mt-1" style="">Manage 12,482 total registered members and their status.</p>
</div>
<div class="flex gap-2">
<button class="bg-surface-container-high px-4 py-2 rounded-lg text-xs font-bold font-['Epilogue'] uppercase tracking-wider flex items-center gap-2 hover:bg-surface-bright transition-colors" style="">
<span class="material-symbols-outlined text-sm" data-icon="filter_list" style="">filter_list</span>
                            Filter
                        </button>
<button class="bg-surface-container-high px-4 py-2 rounded-lg text-xs font-bold font-['Epilogue'] uppercase tracking-wider flex items-center gap-2 hover:bg-surface-bright transition-colors" style="">
<span class="material-symbols-outlined text-sm" data-icon="download" style="">download</span>
                            Export
                        </button>
</div>
</div>
<div class="bg-surface-container-low rounded-2xl overflow-hidden shadow-2xl">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-high/50">
<th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant/50" style="">User</th>
<th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant/50" style="">Status</th>
<th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant/50" style="">Points</th>
<th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant/50" style="">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-white/5">
<tr class="group hover:bg-white/5 transition-colors">
<td class="px-6 py-4" style="">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest">
<img alt="Elena Vasiliev" class="w-full h-full object-cover" data-alt="portrait of a young woman with sharp features and professional makeup in high-contrast cinematic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWLJVgPNrZ7F4r5DJe7yjQdXvtybGtnG9-06Ke52ZOTlq1_OuxjJaBiyudLkuYNClMEBFAaX4rwo3nvEznzIWCfmkalx65BxeOnxI_VbvHEyXa1yX5pNg1nO-b0ikVmUZTONs_LDZJkR4OHMUs4k_-Wm_SSz4B_6jN8-YlCbfYY-9RllIcLUJq6tgCeWp7p65uxUem6PMWQdP65skOJiUc66eQiWHJmQN2ndK6oisM3vK5Mf-cv5KlvlwIiK6loRSJnSczIAHq" style="">
</div>
<div>
<p class="font-bold text-on-surface" style="">Elena Vasiliev</p>
<p class="text-xs text-on-surface-variant/40" style="">elena.v@example.com</p>
</div>
</div>
</td>
<td class="px-6 py-4" style="">
<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-500" style="">Active</span>
</td>
<td class="px-6 py-4 font-['Epilogue'] text-on-surface" style="">1,240 pts</td>
<td class="px-6 py-4" style="">
<button class="text-on-surface-variant/40 hover:text-primary-container transition-colors" style="">
<span class="material-symbols-outlined" data-icon="more_horiz" style="">more_horiz</span>
</button>
</td>
</tr>
<tr class="group hover:bg-white/5 transition-colors">
<td class="px-6 py-4" style="">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest">
<img alt="Marcus Knight" class="w-full h-full object-cover" data-alt="headshot of a stylish man with short hair in a textured wool sweater, dark moody background, film grain texture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA-xEKvdaK6OA19ehtekPWW_-979BYAcHuSOTIvUb3OHHEiIolTT2sRkhIl1GpOaOwgWu-hEBS7gBvvOHhoyYmVmefle0zJxKt5z1af4Xy-SBd6S-69zwv1pKeozq9_x_t-9fmES7pZmBeqM01K5eWTi62aK21tPx3oS3kIico7oco5qLjxH55uaFi9atPlQsexuAgHoj907YPKSmzdQjiZ27-4Bf6nrbjp9Km7cLM4lwkmMaHPwxOL07KvdRzCR09ldfMWhHr6" style="">
</div>
<div>
<p class="font-bold text-on-surface" style="">Marcus Knight</p>
<p class="text-xs text-on-surface-variant/40" style="">knight.m@cinema.io</p>
</div>
</div>
</td>
<td class="px-6 py-4" style="">
<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-500" style="">Active</span>
</td>
<td class="px-6 py-4 font-['Epilogue'] text-on-surface" style="">850 pts</td>
<td class="px-6 py-4" style="">
<button class="text-on-surface-variant/40 hover:text-primary-container transition-colors" style="">
<span class="material-symbols-outlined" data-icon="more_horiz" style="">more_horiz</span>
</button>
</td>
</tr>
<tr class="group hover:bg-white/5 transition-colors">
<td class="px-6 py-4" style="">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest">
<img alt="Julian Rossi" class="w-full h-full object-cover" data-alt="close up of a sophisticated middle aged man with glasses, dramatic shadow play on face, noir aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrbcARrDTR-JZQFh0_XfOdmGcsG_oKqRed11qiCRaJTbs7zLOaOeK-yY_xBjJEghs6OGUdpCFXcRtMbmLztNj8sXrFlpbZeKH_SoCP91cEDYMR5sL9DMoUIjnwRCNFXyuBIo2TVbJoFrSvidmBdAw7FMY8sSMhJxRl4icThDaIHyCWd7T3DNXXUtHcuFlGJs9BHtNu-ddPqteBg9ndumDZGhsSA4lkuH2IdT2tPX4dPH1a-49biM0qzWBCmqVJzam8oGAO-Azr" style="">
</div>
<div>
<p class="font-bold text-on-surface" style="">Julian Rossi</p>
<p class="text-xs text-on-surface-variant/40" style="">julian.rossi@mail.com</p>
</div>
</div>
</td>
<td class="px-6 py-4" style="">
<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-primary-container/10 text-primary-container" style="">Suspended</span>
</td>
<td class="px-6 py-4 font-['Epilogue'] text-on-surface" style="">2,100 pts</td>
<td class="px-6 py-4" style="">
<button class="text-on-surface-variant/40 hover:text-primary-container transition-colors" style="">
<span class="material-symbols-outlined" data-icon="more_horiz" style="">more_horiz</span>
</button>
</td>
</tr>
<tr class="group hover:bg-white/5 transition-colors">
<td class="px-6 py-4" style="">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest">
<img alt="Sophia Laurent" class="w-full h-full object-cover" data-alt="artistic portrait of a woman with long dark hair, glowing skin under soft theater lighting, deep shadow background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzSRzL4qqsKJhi6jzQnnXMYoYqEyCzLgWFLz00lvP8SyNiwg7fp8ur8M-4noGLrxHq9xcCxTtScsZff__sT2RlKwJD9lFyDAN9tDIwveNhua23o7rtdbNiBVxMDow9YY1_ELgfZbjzK6RcxAjvgQfv5RIoVpwXykX4vP_FLW1l_IddJOtagNToVbDFbkR-bV_DioX04xQ7P7yHJJ7rMQUdXE8o8kDHk2fwCt9TTZuHruRAO08ZK-dmhSxg-myOrrT85R4zdFr0" style="">
</div>
<div>
<p class="font-bold text-on-surface" style="">Sophia Laurent</p>
<p class="text-xs text-on-surface-variant/40" style="">laurent.s@web.fr</p>
</div>
</div>
</td>
<td class="px-6 py-4" style="">
<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-500" style="">Active</span>
</td>
<td class="px-6 py-4 font-['Epilogue'] text-on-surface" style="">430 pts</td>
<td class="px-6 py-4" style="">
<button class="text-on-surface-variant/40 hover:text-primary-container transition-colors" style="">
<span class="material-symbols-outlined" data-icon="more_horiz" style="">more_horiz</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
<div class="mt-12 grid grid-cols-3 gap-6">
<div class="bg-surface-container p-6 rounded-2xl border border-white/5 group hover:border-primary-container/30 transition-all">
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/40 mb-2" style="">New Registrations</p>
<h3 class="text-3xl font-black font-['Epilogue'] text-on-surface" style="">142</h3>
<p class="text-xs text-emerald-500 mt-2 flex items-center gap-1" style="">
<span class="material-symbols-outlined text-xs" data-icon="trending_up" style="">trending_up</span>
                            +12% from last month
                        </p>
</div>
<div class="bg-surface-container p-6 rounded-2xl border border-white/5 group hover:border-primary-container/30 transition-all">
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/40 mb-2" style="">Active Sessions</p>
<h3 class="text-3xl font-black font-['Epilogue'] text-on-surface" style="">842</h3>
<p class="text-xs text-on-surface-variant/40 mt-2 flex items-center gap-1" style="">
<span class="material-symbols-outlined text-xs" data-icon="bolt" style="">bolt</span>
                            Real-time streaming
                        </p>
</div>
<div class="bg-surface-container p-6 rounded-2xl border border-white/5 group hover:border-primary-container/30 transition-all">
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/40 mb-2" style="">Loyalty Points Issued</p>
<h3 class="text-3xl font-black font-['Epilogue'] text-on-surface" style="">1.2M</h3>
<p class="text-xs text-primary-container mt-2 flex items-center gap-1" style="">
<span class="material-symbols-outlined text-xs" data-icon="stars" style="">stars</span>
                            Redeemable rewards
                        </p>
</div>
</div>
</div>
<!-- Right Sidebar: Customer Detail Card -->
<aside class="w-96">
<div class="bg-surface-container rounded-3xl overflow-hidden sticky top-24 border border-white/5 shadow-2xl">
<div class="relative h-48">
<div class="absolute inset-0 bg-gradient-to-t from-surface-container via-transparent to-transparent z-10"></div>
<img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" data-alt="cinematic widescreen shot of a stylish Asian man in a leather jacket standing in a neon-lit urban alleyway at night" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZncbfWNfrSTwV5s4V2lSg4B0ZAodFrXlmISGjh-DReIKxJ0ZU5M3Ez81wB4PZjtCjsiZWPSYl7V99A7Jyt23lv9bEpu-_tTp70IuoMxaYRVnmrKY6qa5ldVe2-5mrscu675ScEIQ58x_1d5x3HWe-jqX300ikQanU9nt7FMxIedNHDc1lW5e4Mi4nS1fdcmep6MWUeZppF4sBJ4_0-2T150CYuxkSDVTr7xZU7ILl1WlsyCMRZjwguDiNHVby8AVmoplqsUUA" style="">
<div class="absolute bottom-4 left-6 z-20">
<span class="px-2 py-1 bg-primary-container text-[8px] font-black uppercase tracking-widest rounded mb-2 inline-block" style="">Pro Member</span>
<h3 class="text-2xl font-black font-['Epilogue'] tracking-tighter text-white" style="">Hai Nguyen Ngoc</h3>
<p class="text-xs text-white/60" style="">Member Since 2021</p>
</div>
</div>
<div class="p-8">
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="bg-surface-container-low p-4 rounded-2xl">
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/40 mb-1" style="">Lifetime Value</p>
<p class="text-xl font-black font-['Epilogue'] text-[#E50914]" style="">$4,820</p>
</div>
<div class="bg-surface-container-low p-4 rounded-2xl">
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/40 mb-1" style="">Total Bookings</p>
<p class="text-xl font-black font-['Epilogue'] text-on-surface" style="">156</p>
</div>
</div>
<div class="flex gap-3 mb-10">
<button class="flex-1 bg-on-surface text-surface py-3 rounded-xl font-bold font-['Epilogue'] text-xs uppercase tracking-widest hover:brightness-90 transition-all flex items-center justify-center gap-2" style="">
<span class="material-symbols-outlined text-sm" data-icon="edit" style="">edit</span>
                                Edit Profile
                            </button>
<button class="flex-1 bg-transparent border border-white/10 text-on-surface-variant/60 py-3 rounded-xl font-bold font-['Epilogue'] text-xs uppercase tracking-widest hover:bg-primary-container/10 hover:text-primary-container hover:border-primary-container/30 transition-all flex items-center justify-center gap-2" style="">
<span class="material-symbols-outlined text-sm" data-icon="block" style="">block</span>
                                Suspend
                            </button>
</div>
<div class="space-y-6">
<div class="flex items-center justify-between">
<h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant" style="">Recent Bookings</h4>
<button class="text-[10px] font-bold text-primary-container uppercase hover:underline" style="">View All</button>
</div>
<div class="space-y-4">
<div class="flex items-center gap-4 group">
<div class="w-12 h-16 rounded-lg overflow-hidden bg-surface-container-lowest">
<img class="w-full h-full object-cover" data-alt="Oppenheimer movie poster style image featuring a dramatic orange explosion silhouette against a black background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCptuhHy_TxtOFf05LqS309IDer2BIOgnTvYeX0Anu0r2P4zPE63aDJq53RlJwWrGxxApwOebgo_HNXwpopFxaYXDXELajThDbpUlLT_dAIMdtrjAysxwDElTEOJxOdUpKsPa3XlDA8KsowDO-CXFOcr-WKObR0x-Y06AC9rftV1DTK2fl8rYfYLmhFw4hTuVu2ShH7DfqyzLcfqiwldF_Fc2TAZGYsC_5NKMe1f-WeT3hnUDkPmq9YleQsfcwCkD0oxo9u4iSY" style="">
</div>
<div class="flex-1">
<p class="text-sm font-bold text-on-surface group-hover:text-primary-container transition-colors" style="">Oppenheimer</p>
<p class="text-[10px] text-on-surface-variant/40" style="">IMAX Laser • Oct 12, 2023</p>
</div>
<p class="text-xs font-bold font-['Epilogue']" style="">$24.50</p>
</div>
<div class="flex items-center gap-4 group">
<div class="w-12 h-16 rounded-lg overflow-hidden bg-surface-container-lowest">
<img class="w-full h-full object-cover" data-alt="Dune Part Two poster concept with silhouettes of people on a vast orange desert dune under a giant sun" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoVDbDnrazkikN1RlHTwWhhWPNaQrLgAZPovCf2e8rfN92AO7rfDQFDmWGUaj7sGDHJ_bBVOmMnMjDP8JpquMBsU4y6ZyhbcE-9H-D6fvcfR4cVIkKitcGolMtmU2CqnEQuAmQBD8Avsc7aV5XXqSv0voEWoTMqCSdzZVwFF06bLD7ReBKPdDoVoZXKe8se9tK0HS34nQkPzT7OVRjf3X97mAU7-IyQ2cC7kdPjunEkoorrrUn1eBm1qUrrEVEbRYtLsREVKHM" style="">
</div>
<div class="flex-1">
<p class="text-sm font-bold text-on-surface group-hover:text-primary-container transition-colors" style="">Dune: Part Two</p>
<p class="text-[10px] text-on-surface-variant/40" style="">Screen 4 • Mar 15, 2024</p>
</div>
<p class="text-xs font-bold font-['Epilogue']" style="">$18.00</p>
</div>
<div class="flex items-center gap-4 group">
<div class="w-12 h-16 rounded-lg overflow-hidden bg-surface-container-lowest">
<img class="w-full h-full object-cover" data-alt="Avatar movie style bioluminescent jungle forest with glowing blue and green plants and floating seeds" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBa4jYZ7PtH9pdfSz6PF31NBrCJ5PQ7btBVLFGkUraHXACHDN0_CuxyE65SgfdUd3hluCZmqNL15zJcauqnnj1yPprPaJlp3ArcYdR4ID0uJ24HUuzxWkUmsewurYoT4qoqmufGU5hHLtr-uTzTydHSGpkvERO3Rg7sjCqlVYij_A_Unfc8Hjb9CWpckmLEhmylOtZ2brwYy_SiMEe3uuiDiHvOKENTjPSWhhoSkxtu-UExWqpqmImpESIeRKJlG4d4nTrABpz2" style="">
</div>
<div class="flex-1">
<p class="text-sm font-bold text-on-surface group-hover:text-primary-container transition-colors" style="">Avatar: Way of Water</p>
<p class="text-[10px] text-on-surface-variant/40" style="">VIP Lounge • Dec 20, 2023</p>
</div>
<p class="text-xs font-bold font-['Epilogue']" style="">$42.00</p>
</div>
</div>
</div>
<div class="mt-10 p-4 rounded-2xl bg-gradient-to-br from-primary-container to-[#930007] text-white">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined" data-icon="star" style="font-variation-settings: &quot;FILL&quot; 1;">star</span>
<p class="text-[10px] font-black uppercase tracking-widest" style="">VIP Privilege</p>
</div>
<p class="text-xs opacity-90 leading-relaxed" style="">This customer is eligible for a complimentary Premiere Upgrade on their next visit.</p>
</div>
</div>
</div>
</aside>
</div>
</main>
</body></html>