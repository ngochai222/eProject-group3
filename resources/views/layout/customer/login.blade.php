<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cinebook Login</title>
<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style data-purpose="custom-fonts">
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
<style data-purpose="layout-adjustments">
.cinema-bg {
    background-image: url(Login.png);
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;

    width: 100%;
    height: 100vh;
    }
/* Ensure the login container fills the viewport correctly on mobile */
.login-container {
    min-height: 100dvh
    }
/* Style the input focus ring to match theme */
input:focus {
    outline: none;
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2) !important
    }</style>
</head>
<body class="bg-[#0a0a0a] text-white">
<main class="login-container flex flex-col md:flex-row w-full overflow-hidden">
<section class="w-full md:w-[45%] lg:w-[40%] bg-black flex items-center justify-center p-8 md:p-12 z-10" data-purpose="login-form-area">
<div class="w-full max-w-sm space-y-8">

<div class="text-center md:text-left">
<h1 class="text-3xl md:text-4xl font-bold tracking-tight">
            WELCOME TO <br/>
<span class="text-[#ef4444]">CINEBOOK</span>
</h1>
</div>
<!-- Form Fields -->
<form action="{{ route('login') }}" class="mt-8 space-y-6" method="POST">
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
@if (session('error'))
<div class="mb-4 p-3 bg-red-900/50 border border-red-500 rounded-lg">
    <p class="text-sm text-red-300">{{ session('error') }}</p>
</div>
@endif
@if (session('success'))
<div class="mb-4 p-3 bg-green-900/50 border border-green-500 rounded-lg">
    <p class="text-sm text-green-300">{{ session('success') }}</p>
</div>
@endif
<div class="space-y-5">
<!-- Username Input -->
<div data-purpose="username-field">
<label class="block text-xs font-medium text-gray-400 mb-2 uppercase tracking-wider" for="username">Username</label>
<input class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm focus:ring-2 focus:ring-red-500" id="username" name="username" placeholder="Enter your username..." required="" type="text"/>
</div>
<!-- Password Input -->
<div data-purpose="password-field">
<label class="block text-xs font-medium text-gray-400 mb-2 uppercase tracking-wider" for="password">Password</label>
<input class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm focus:ring-2 focus:ring-red-500" id="password" name="password" placeholder="Enter your password..." required="" type="password"/>
</div>
</div>
<!-- Options: Remember Me & Forgot Password -->
<div class="flex items-center justify-between text-xs">
<div class="flex items-center">
<input class="h-4 w-4 rounded border-gray-700 bg-gray-800 text-red-600 focus:ring-red-500 focus:ring-offset-black" id="remember-me" name="remember-me" type="checkbox"/>
<label class="ml-2 block text-gray-400" for="remember-me">Remember me</label>
</div>
<a class="font-medium text-gray-400 hover:text-white transition-colors" href="{{ route('password.request') }}">Forgot password?</a>
</div>
<!-- Submit Button -->
<div data-purpose="submit-button-container">
<button class="group relative flex w-full justify-center rounded-xl bg-[#ef4444] py-3 text-sm font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200" type="submit">
              Login
            </button>
</div>
</form>
<p class="text-center text-sm text-gray-500">
          No Account?
          <a class="font-semibold text-gray-300 hover:text-white transition-colors" href="{{ route('register') }}">Register</a>
</p>
</div>
</section>

<section class="hidden md:block md:flex-1 cinema-bg relative" data-purpose="visual-background-area">

<div class="absolute inset-0 bg-black/10"></div>
</section>

<div class="md:hidden w-full h-48 cinema-bg order-first"></div>
</main>

</body>
</html>