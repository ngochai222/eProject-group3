<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@700;800;900&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[#131313] text-white flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-[#E50914] mb-2">CINEBOOK</h1>
            <h2 class="text-xl font-bold text-white">Admin Login</h2>
            <p class="text-gray-400 text-sm">Enter your credentials to access admin panel</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-4">
                    <ul class="text-red-400 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                    Email Address
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 bg-[#1f1f1f] border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-[#E50914] focus:border-transparent transition"
                    placeholder="admin@gmail.com"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                    Password
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                    class="w-full px-4 py-3 bg-[#1f1f1f] border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-[#E50914] focus:border-transparent transition"
                    placeholder="Enter your password"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-[#E50914] hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 active:scale-95"
            >
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-400 text-sm">
                Default credentials: admin@gmail.com / 123456
            </p>
        </div>
    </div>
</body>
</html>