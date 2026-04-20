<!DOCTYPE html>
<html class="dark" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cinebook - Become a Member</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&amp;family=Inter:wght@300;400;600&amp;family=Bebas+Neue&amp;display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script>
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
      .textured-bg {
        background-image: url(https://lh3.googleusercontent.com/aida-public/AB6AXuAhC4O5ISSrL7PvoOeJ9oHtUv38iWzkCbXhC6Wxyid8VB39jjXV8Qk7IePEWzRmXNevYy0vT1VOr94AYG3MQnvmocB5m0Nm7vHmoDuuY6Knl_yUQ5DLaFA6IvLhlSilECWXFsOznmW3PRtXOqqMeGgaObHjupHskhpVTYQAH3x3pTKIUlA-Rh5FEZ6X-xylE01WzWoNcQzKMKm1j_v57VZpxgs3Axmemuc38TzMGYkc32hmwHnB7DMejrlDOntMZcqOP_hS1egw);
        background-color: #f5e6d3;
      }

      input::placeholder {
        color: #9ca3af;
        font-size: 0.85rem;
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
            BECOME A MEMBER
          </h1>
          <div class="h-1 w-20 bg-primary mx-auto"></div>
        </header>

        <form class="space-y-4 max-w-md mx-auto" method="POST" action="{{ route('register') }}">
          @csrf
          @if ($errors->any())
            <div class="mb-4 p-3 bg-red-900/50 border border-red-500 rounded-lg">
              <ul class="text-sm text-red-300">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (session('success'))
            <div class="mb-4 p-3 bg-green-900/50 border border-green-500 rounded-lg">
              <p class="text-sm text-green-300">{{ session('success') }}</p>
            </div>
          @endif

          <div>
            <label
              class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
              >Full Name</label
            >
            <input
              class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
              placeholder="Enter your full name"
              type="text"
              name="customer_name"
              value="{{ old('customer_name') }}"
              required
            />
          </div>

          <div>
            <label
              class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
              >Email</label
            >
            <input
              class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
              placeholder="Enter your email"
              type="email"
              name="customer_email"
              value="{{ old('customer_email') }}"
              required
            />
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label
                class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
                >Password</label
              >
              <input
                class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
                placeholder="Enter password"
                type="password"
                name="customer_password"
                required
              />
            </div>
            <div>
              <label
                class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
                >Confirm Password</label
              >
              <input
                class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
                placeholder="Confirm password"
                type="password"
                name="customer_password_confirmation"
                required
              />
            </div>
          </div>

          <div>
            <label
              class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
              >Gender</label
            >
            <select
              class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
              name="customer_gender"
              required
            >
              <option value="">Select gender</option>
              <option value="Male" {{ old('customer_gender') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('customer_gender') == 'Female' ? 'selected' : '' }}>Female</option>
              <option value="Other" {{ old('customer_gender') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>

          <div>
            <label
              class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
              >Date of Birth</label
            >
            <input
              class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
              type="date"
              name="customer_date_of_birth"
              value="{{ old('customer_date_of_birth') }}"
              min="1900-01-01"
              max="{{ date('Y-m-d') }}"
              required
            />
          </div>

          <div>
            <label
              class="block text-[10px] uppercase tracking-widest text-gray-400 mb-1 ml-1"
              >Phone Number</label
            >
            <input
              class="w-full bg-white text-black border-none py-3 px-4 rounded focus:ring-2 focus:ring-primary"
              placeholder="Enter phone number"
              type="tel"
              name="customer_phone"
              value="{{ old('customer_phone') }}"
              required
            />
          </div>

          

          <div class="pt-6">
            <button
              class="w-full py-3 border-2 border-primary text-primary font-display text-xl tracking-widest hover:bg-primary hover:text-white transition-all duration-300 rounded"
              type="submit"
            >
              Register
            </button>
          </div>
        </form>

        <div class="text-center mt-6">
          <p class="text-sm text-gray-400">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary hover:text-white transition-colors font-medium">
              Log in here
            </a>
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
        <span class="material-icons">chevron_left</span>
      </a>
    </div>
  </body>
</html>