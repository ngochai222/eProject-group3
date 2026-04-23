<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SuperAdmin Login - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#070a0f] text-white min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-[#E50914] mb-1">CINEBOOK</h1>
            <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest">Super Admin Portal</p>
        </div>

        <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-8">
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-3 mb-4">
                    <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('superadmin.login.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-widest block mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-black rounded-xl text-white border border-gray-700 focus:border-yellow-400 outline-none">
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-widest block mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-black rounded-xl text-white border border-gray-700 focus:border-yellow-400 outline-none">
                </div>
                <button type="submit"
                    class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-black py-3 rounded-xl transition">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>
