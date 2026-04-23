<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cinebook Register</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; }
    .cinema-bg {
        background-image: url(/Login.png);
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh;
    }
    .login-container { min-height: 100dvh; }
    input:focus {
        outline: none;
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 2px rgba(239,68,68,0.2) !important;
    }
</style>
</head>
<body class="bg-[#0a0a0a] text-white">
<main class="login-container flex flex-col md:flex-row w-full overflow-hidden">

    <section class="w-full md:w-[45%] lg:w-[40%] bg-black flex items-center justify-center p-8 md:p-12 z-10">
        <div class="w-full max-w-sm space-y-6">

            <div class="text-center md:text-left">
                <a href="{{ url('/') }}" class="inline-flex items-center text-gray-400 hover:text-white transition mb-4">
                    <span style="font-size:28px;" class="material-icons" style="font-size:28px;">arrow_back</span>
                </a>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight">
                    JOIN <br/><span class="text-[#ef4444]">CINEBOOK</span>
                </h1>
            </div>

            <form action="{{ route('register') }}" class="space-y-4" method="POST">
                @csrf

                @if($errors->any())
                <div class="p-3 bg-red-900/50 border border-red-500 rounded-lg">
                    <ul class="text-sm text-red-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="p-3 bg-green-900/50 border border-green-500 rounded-lg">
                    <p class="text-sm text-green-300">{{ session('success') }}</p>
                </div>
                @endif

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Full Name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm"
                        placeholder="Enter your full name">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}" required
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm"
                        placeholder="Enter your email">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Phone</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm"
                        placeholder="Enter your phone number">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Gender</label>
                        <select name="customer_gender" required
                            class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none text-sm">
                            <option value="">Select</option>
                            <option value="Male" {{ old('customer_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('customer_gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('customer_gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Date of Birth</label>
                        <input type="date" name="customer_date_of_birth" value="{{ old('customer_date_of_birth') }}" required
                            class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Password</label>
                    <input type="password" name="customer_password" required
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm"
                        placeholder="Min 6 characters">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Confirm Password</label>
                    <input type="password" name="customer_password_confirmation" required
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-900 border-none placeholder-gray-400 text-sm"
                        placeholder="Repeat password">
                </div>

                <button type="submit"
                    class="flex w-full justify-center rounded-xl bg-[#ef4444] py-3 text-sm font-semibold text-white hover:bg-red-700 transition-all duration-200">
                    Create Account
                </button>
            </form>

            <p class="text-center text-sm text-gray-500">
                Already have an account?
                <a class="font-semibold text-gray-300 hover:text-white transition-colors" href="{{ route('login') }}">Sign In</a>
            </p>
        </div>
    </section>

    <section class="hidden md:block md:flex-1 cinema-bg relative">
        <div class="absolute inset-0 bg-black/10"></div>
    </section>

    <div class="md:hidden w-full h-48 cinema-bg order-first"></div>
</main>
</body>
</html>
