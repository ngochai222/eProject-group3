<!DOCTYPE html>
<html class="dark" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cinebook - Forgot Password</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;700;800;900&amp;family=Manrope:wght@400;500;600;700;800&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#E50914",
              "background-light": "#F5E6D3",
              "background-dark": "#0A0A0A",
            },
            fontFamily: {
              display: ["Bebas Neue", "cursive"],
              serif: ["Playfair Display", "serif"],
              sans: ["Inter", "sans-serif"],
            },
            borderRadius: {
              DEFAULT: "4px",
            },
          },
        },
      };
    </script>
    <style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }

      .grain-overlay {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        opacity: 0.05;
        pointer-events: none;
      }

      .textured-bg {
        background-image: url(https://lh3.googleusercontent.com/aida-public/AB6AXuAhC4O5ISSrL7PvoOeJ9oHtUv38iWzkCbXhC6Wxyid8VB39jjXV8Qk7IePEWzRmXNevYy0vT1VOr94AYG3MQnvmocB5m0Nm7vHmoDuuY6Knl_yUQ5DLaFA6IvLhlSilECWXFsOznmW3PRtXOqqMeGgaObHjupHskhpVTYQAH3x3pTKIUlA-Rh5FEZ6X-xylE01WzWoNcQzKMKm1j_v57VZpxgs3Axmemuc38TzMGYkc32hmwHnB7DMejrlDOntMZcqOP_hS1egw);
        background-color: #f5e6d3;
      }

      body {
        min-height: max(884px, 100dvh);
      }
    </style>
  </head>
  <body class="bg-background-dark font-sans text-white min-h-screen">
    <div class="flex flex-col min-h-screen">
      <section class="flex-1 bg-background-dark px-6 py-10">
        <header class="mb-8 text-center">
          <h1 class="font-display text-5xl tracking-widest text-white mb-2">
            Forgot Your Password?
          </h1>
          <div class="h-1 w-20 bg-primary mx-auto"></div>
        </header>

        <form class="space-y-4 max-w-md mx-auto" method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="space-y-2">
            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1" for="email">Email Address</label>
            <div class="relative">
              <input
                class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
                id="email"
                name="email"
                placeholder="name@email.com"
                type="email"
                value="{{ old('email') }}"
                required
              />
            </div>
          </div>

          @if ($errors->has('email'))
            <div class="mb-4 p-3 bg-red-900/50 border border-red-500 rounded-lg">
              <p class="text-sm text-red-300">{{ $errors->first('email') }}</p>
            </div>
          @endif
          @if (session('status'))
            <div class="mb-4 p-3 bg-green-900/50 border border-green-500 rounded-lg">
              <p class="text-sm text-green-300">{{ session('status') }}</p>
            </div>
          @endif

          <!-- Primary Action -->
          <div class="pt-6">
            <button class="w-full py-3 border-2 border-primary text-primary font-display text-xl tracking-widest hover:bg-primary hover:text-white transition-all duration-300 rounded" type="submit">
              Send Reset Link
            </button>
          </div>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-6">
          <p class="text-sm text-gray-400">
            Remember your password?
            <a href="{{ route('login') }}" class="text-primary hover:text-white transition-colors font-medium">Log in here</a>
          </p>
        </div>
      </section>

        <div class="mt-8 pt-8 border-t border-gray-300 w-full items-center justify-center text-center">
          <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em]">Cinebook Noir Collection © 2026</p>
        </div>
      
    </div>

    <div class="fixed top-4 left-4 z-50">
      <a
        href="{{ route('login') }}"
        class="w-10 h-10 bg-white/10 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-colors"
      >
        <span class="material-symbols-outlined">chevron_left</span>
      </a>
    </div>
  </body>
</html>