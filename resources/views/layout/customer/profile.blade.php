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
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Full Name</label>
                <input name="customer_name" type="text" value="{{ old('customer_name', $user->customer_name) }}"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" />
                @error('customer_name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Phone</label>
                <input name="customer_phone" type="text" value="{{ old('customer_phone', $user->customer_phone) }}"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" />
                @error('customer_phone')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Address</label>
                <input name="customer_address" type="text" value="{{ old('customer_address', $user->customer_address) }}"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" />
                @error('customer_address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Gender</label>
                    <select name="customer_gender" class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2">
                        <option value="Male" {{ $user->customer_gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->customer_gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $user->customer_gender == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Date of Birth</label>
                    <input name="customer_date_of_birth" type="date"
                        value="{{ old('customer_date_of_birth', $user->customer_date_of_birth ? $user->customer_date_of_birth->format('Y-m-d') : '') }}"
                        class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" />
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Avatar</label>
                <input id="customer_avatar" name="customer_avatar" type="file" accept="image/*"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2" />
                @error('customer_avatar')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
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

        @if($unusedTickets->isEmpty())
        <div class="bg-white/10 rounded-xl p-6 text-center">
            <p class="text-gray-400 mb-4">YOU CURRENTLY DO NOT HAVE ANY TICKETS</p>
            <a href="{{ url('/') }}" class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700 inline-block">
                BUY TICKETS
            </a>
        </div>
        @else
        <div class="space-y-3">
            @foreach($unusedTickets as $ticket)
            <div class="bg-white/10 rounded-xl p-4 flex items-center gap-4">
                <img src="{{ $ticket->poster ? asset('uploads/'.$ticket->poster) : 'https://via.placeholder.com/60x80?text=?' }}"
                     class="w-12 h-16 rounded object-cover flex-shrink-0">
                <div class="flex-1">
                    <p class="font-bold text-white">{{ $ticket->title }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($ticket->start_time)->format('D, d M Y · H:i') }}</p>
                    @if($ticket->seats)
                        <p class="text-xs text-yellow-400 mt-1">Seats: {{ $ticket->seats }}</p>
                    @endif
                </div>
                <span class="text-yellow-400 font-bold">${{ number_format($ticket->total_price, 2) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-4 text-center mt-8 px-6 gap-4">
        <div>
            <p class="text-xl font-bold">{{ $totalTickets }}</p>
            <p class="text-xs text-gray-400">TICKETS</p>
        </div>
        <div>
            <p class="text-xl font-bold">{{ $totalTickets }}</p>
            <p class="text-xs text-gray-400">WATCHED</p>
        </div>
        <div>
            <p class="text-xl font-bold">0</p>
            <p class="text-xs text-gray-400">RATED</p>
        </div>
        <div>
            <p class="text-xl font-bold">0</p>
            <p class="text-xs text-gray-400">COMMENT</p>
        </div>
    </div>

    <!-- RECENT MOVIES -->
    <div class="mt-10 px-6">
        <div class="flex justify-between items-center">
            <h3 class="text-sm text-gray-400">RECENTLY WATCHED MOVIES</h3>
            <a href="{{ route('tickets.my') }}" class="text-xs text-gray-400 hover:text-white">VIEW MORE</a>
        </div>

        @if($recentlyWatched->isEmpty())
        <p class="text-gray-600 text-sm mt-4">No movies watched yet.</p>
        @else
        <div class="flex gap-4 mt-4 overflow-x-auto pb-2">
            @foreach($recentlyWatched as $movie)
            <div class="flex-shrink-0 w-28">
                <img src="{{ $movie->poster ? asset('uploads/'.$movie->poster) : 'https://via.placeholder.com/112x160?text=?' }}"
                     class="w-28 h-40 rounded-lg object-cover">
                <p class="text-xs text-gray-400 mt-1 truncate">{{ $movie->title }}</p>
                <p class="text-[10px] text-gray-600">{{ \Carbon\Carbon::parse($movie->start_time)->format('d M Y') }}</p>
            </div>
            @endforeach
        </div>
        @endif
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