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
                        "surface-container-highest": "#000000ff",
                        "error": "#ffb4ab",
                        "secondary-fixed": "#ffdad5",
                        "on-surface": "#e2e2e2",
                        "primary-fixed": "#ffdad5",
                        "outline": "#af8782",
                        "on-primary": "#690003",
                        "surface-container-high": "#000000ff",
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
                        "surface-bright": "#000000ff",
                        "inverse-surface": "#e2e2e2",
                        "on-primary-fixed-variant": "#930007",
                        "primary-fixed-dim": "#ffb4aa",
                        "surface-variant": "#000000ff",
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
@include('components.header')
<main class="pt-24 pb-32 px-6 max-w-5xl mx-auto">
<!-- Search/Filter Section -->
<section class="mb-10 space-y-6">
<div class="relative group">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant opacity-50" data-icon="search">search</span>
<input class="w-full bg-on-primary-container border-none py-4 pl-12 pr-4 rounded-xl text-on-surface-fixed-variant placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-primary-container/40 transition-all font-body" placeholder="Search for cinema name or district..." type="text"/>
</div>
</section>
<!-- Cinema List (Asymmetric Bento-inspired Layout) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
@forelse($cinemas as $cinema)
<div class="group relative overflow-hidden rounded-3xl bg-surface-container-low border border-white/5 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-primary-container/10">
<div class="relative h-64 w-full">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
     src="{{ $cinema->cinema_image ? asset('uploads/'.$cinema->cinema_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDE33ZEIhZQAV3SHcQzMs_VeHb_hGcSazMvdfjPFMX6n2B0I9JX_kjYygHKm2f2AIT150_4v28n0ERdM6J9-glVU8tRxusiWhZFzNtm9FWIF4uokaxi_cxGzz5VMHQAcfkMwnXhb4hmVKyM0KgOrv6YCCT52KRCIuSN_8vixTyRnQxtAoPLbL5fxgEo4fvCn0ZqKBaEXb0RxkcCT-gFwk0Wt2ZxnbdAbtC_cwMNdAVPqhW6OPv5n-X0cdQ0VQW5OUmBEG0KAVlZ' }}"
     alt="{{ $cinema->cinema_name }}"/>
<div class="absolute inset-0 cinematic-gradient"></div>
</div>
<div class="p-6 space-y-3">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-2xl font-black tracking-tight text-on-surface">{{ $cinema->cinema_name }}</h3>
<p class="font-body text-sm text-on-surface/60 mt-1 flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="location_on">location_on</span>
{{ $cinema->cinema_address }}
</p>
</div>
</div>
<div class="pt-4 flex items-center justify-between">
<button class="bg-primary-container hover:bg-on-primary-fixed-variant text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg active:scale-95">SELECT</button>
</div>
</div>
</div>
@empty
<div class="col-span-2 text-center text-gray-500 py-20">No cinemas available.</div>
@endforelse
</div>
</main>
</body></html>