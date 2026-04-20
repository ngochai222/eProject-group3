<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-black text-white">

<div class="min-h-screen bg-gradient-to-b from-black via-red-900/40 to-black">

    @php
        use Illuminate\Support\Str;
    @endphp

    <!-- PROFILE HEADER -->
    <div class="text-center pt-10">
        <div class="px-6 pb-2 text-left">
            <a href="{{ url('/') }}" class="inline-flex items-center text-gray-400 hover:text-white transition">
                <span class="material-icons" style="font-size:32px;">arrow_back</span>
            </a>
        </div>
        @php
            $avatarUrl = $user->customer_avatar
                ? (Str::startsWith($user->customer_avatar, ['http://', 'https://'])
                    ? $user->customer_avatar
                    : (Str::startsWith($user->customer_avatar, 'customer_avatars/')
                        ? asset($user->customer_avatar)
                        : asset('storage/' . $user->customer_avatar)))
                : asset('images/default-avatar.png');
        @endphp

        <div class="relative inline-block">
            <img id="profileAvatarImg" src="{{ $avatarUrl }}"
                 class="w-24 h-24 rounded-full border-4 border-red-500 object-cover">

            <!-- edit icon -->
            <button type="button" id="editProfileBtn" class="absolute bottom-0 right-0 bg-red-500 p-2 rounded-full text-xs hover:bg-red-600">
                ✎
            </button>
        </div>

        <h2 class="mt-3 font-bold text-lg">{{ $user->customer_name }}</h2>
        <p class="text-gray-400 text-sm">{{ $user->customer_email }}</p>
    </div>

    @if(session('success'))
        <div class="mx-6 mt-6 rounded-xl bg-green-500/20 border border-green-500 p-4 text-sm text-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div id="editProfileForm" class="hidden mx-6 mt-6 rounded-xl bg-white/10 border border-gray-800 p-6">
        <h3 class="text-white text-lg font-semibold mb-4">Edit profile</h3>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2" for="customer_avatar">Avatar</label>
                <input id="customer_avatar" name="customer_avatar" type="file" accept="image/*" class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" />
                @error('customer_avatar')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2" for="customer_address">Address</label>
                <input id="customer_address" name="customer_address" type="text" value="{{ old('customer_address', $user->customer_address) }}"
                       class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" placeholder="Enter your address" />
                @error('customer_address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <button type="button" id="cancelEditBtn" class="rounded-lg border border-gray-700 px-4 py-2 text-sm text-gray-200 hover:border-gray-500">Cancel</button>
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Save changes</button>
            </div>
        </form>
    </div>

    <!-- UNUSED TICKETS -->
    <div class="mt-8 px-6">
        <h3 class="text-sm text-gray-400 mb-2">UNUSED TICKETS</h3>

        <div class="bg-white/10 rounded-xl p-6 text-center">
            <p class="text-gray-400 mb-4">YOU CURRENTLY DO NOT HAVE ANY TICKETS</p>
            <button class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700">
                BUY TICKETS
            </button>
        </div>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-4 text-center mt-8 px-6 gap-4">
        <div>
            <p class="text-xl font-bold">36</p>
            <p class="text-xs text-gray-400">TICKETS</p>
        </div>

        <div>
            <p class="text-xl font-bold">{{ $watched }}</p>
            <p class="text-xs text-gray-400">WATCHED</p>
        </div>

        <div>
            <p class="text-xl font-bold">{{ $rated }}</p>
            <p class="text-xs text-gray-400">RATED</p>
        </div>

        <div>
            <p class="text-xl font-bold">{{ $comments }}</p>
            <p class="text-xs text-gray-400">COMMENT</p>
        </div>
    </div>

    <!-- RECENT MOVIES -->
    <div class="mt-10 px-6">
        <div class="flex justify-between items-center">
            <h3 class="text-sm text-gray-400">RECENTLY WATCHED MOVIES</h3>
            <a href="#" class="text-xs text-gray-400">VIEW MORE</a>
        </div>

        <div class="flex gap-4 mt-4 overflow-x-auto">
            <img src="{{ asset('images/movie1.jpg') }}" class="w-32 rounded-lg">
            <img src="{{ asset('images/movie2.jpg') }}" class="w-32 rounded-lg">
            <img src="{{ asset('images/movie3.jpg') }}" class="w-32 rounded-lg">
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="mt-auto bg-black text-red px-6 md:px-16 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h2 class="text-xl font-bold tracking-widest mb-4 text-[#E50914]">CINEBOOK</h2>
            <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                Redefining the cinematic experience with premium curation, 
                state-of-the-art technology, and absolute Noir aesthetics.
            </p>
        </div>
        <div>
            <h3 class="text-sm font-bold uppercase tracking-widest mb-4">Contact</h3>
            <p class="text-gray-400 text-sm">+84 566 940 182</p>
            <p class="text-gray-400 text-sm mt-2">
                12 Ly Tu Trong, Ninh Kieu, Can Tho, Viet Nam
            </p>
        </div>
        <div>
            <h3 class="text-sm font-bold uppercase tracking-widest mb-4">Connect</h3>
            <p class="text-gray-400 text-sm hover:text-white cursor-pointer transition">Instagram</p>
            <p class="text-gray-400 text-sm mt-2 hover:text-white cursor-pointer transition">Facebook</p>
        </div>

    </div>
    <div class="mt-10 border-t border-gray-800 pt-6 text-center text-gray-500 text-xs tracking-widest">
        © 2026 CINEBOOK. ALL RIGHTS RESERVED
    </div>
</footer>

    <script>
        const editButton = document.getElementById('editProfileBtn');
        const cancelButton = document.getElementById('cancelEditBtn');
        const editForm = document.getElementById('editProfileForm');

        editButton?.addEventListener('click', () => {
            editForm.classList.toggle('hidden');
            editForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        cancelButton?.addEventListener('click', () => {
            editForm.classList.add('hidden');
        });

        const avatarInput = document.getElementById('customer_avatar');
        const profileAvatarImg = document.getElementById('profileAvatarImg');

        avatarInput?.addEventListener('change', (event) => {
            const file = event.target.files?.[0];
            if (!file) {
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                if (profileAvatarImg && e.target?.result) {
                    profileAvatarImg.src = e.target.result;
                }
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>