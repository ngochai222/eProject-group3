<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-[#0f0f0f] text-white min-h-screen">

@include('components.header')

<div class="pt-20 pb-16 max-w-lg mx-auto px-4">

    {{-- Back --}}
    <a href="{{ url('/') }}" class="inline-flex items-center text-[#E50914] text-xs font-bold uppercase tracking-widest mb-6 hover:underline">
        ← Profile
    </a>

    @if(session('success'))
    <div id="toast" class="bg-green-500/20 border border-green-500/30 text-green-400 rounded-xl px-4 py-3 mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Avatar + Name --}}
    <div class="text-center mb-8">
        <div class="relative inline-block">
            @php
                $avatarUrl = $user->customer_avatar
                    ? (str_starts_with($user->customer_avatar, 'http') ? $user->customer_avatar : asset($user->customer_avatar))
                    : 'https://ui-avatars.com/api/?name='.urlencode($user->customer_name).'&background=E50914&color=fff&size=96';
            @endphp
            <img id="profileAvatarImg" src="{{ $avatarUrl }}"
                 class="w-24 h-24 rounded-full border-4 border-[#E50914] object-cover mx-auto">
            <button type="button" id="editProfileBtn"
                class="absolute bottom-0 right-0 w-7 h-7 bg-[#E50914] rounded-full flex items-center justify-center hover:bg-red-700 transition">
                <span class="material-icons text-white text-sm">edit</span>
            </button>
        </div>
        <h2 class="mt-3 font-bold text-lg">{{ $user->customer_name }}</h2>
        <p class="text-gray-400 text-sm">{{ $user->customer_email }}</p>
    </div>

    {{-- Edit Form --}}
    <div id="editProfileForm" class="hidden mb-8 rounded-2xl bg-white/5 border border-gray-800 p-6">
        <h3 class="text-white text-lg font-semibold mb-4">Edit Profile</h3>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PATCH')

            <div>
                <label class="text-xs text-gray-400 uppercase tracking-widest block mb-1">Full Name</label>
                <input name="customer_name" type="text" value="{{ old('customer_name', $user->customer_name) }}"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2 outline-none focus:border-[#E50914]">
            </div>
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-widest block mb-1">Phone</label>
                <input name="customer_phone" type="text" value="{{ old('customer_phone', $user->customer_phone) }}"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2 outline-none focus:border-[#E50914]">
            </div>
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-widest block mb-1">Address</label>
                <input name="customer_address" type="text" value="{{ old('customer_address', $user->customer_address) }}"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2 outline-none focus:border-[#E50914]">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-widest block mb-1">Gender</label>
                    <select name="customer_gender" class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2 outline-none">
                        <option value="Male" {{ $user->customer_gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->customer_gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $user->customer_gender == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-widest block mb-1">Date of Birth</label>
                    <input name="customer_date_of_birth" type="date"
                        value="{{ old('customer_date_of_birth', $user->customer_date_of_birth ? $user->customer_date_of_birth->format('Y-m-d') : '') }}"
                        class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2 outline-none">
                </div>
            </div>
            <div>
                <label class="text-xs text-gray-400 uppercase tracking-widest block mb-1">Avatar</label>
                <input id="customer_avatar" name="customer_avatar" type="file" accept="image/*"
                    class="w-full rounded-lg border border-gray-700 bg-black/50 text-white p-2">
            </div>
            <div class="flex gap-3 justify-end pt-2">
                <button type="button" id="cancelEditBtn"
                    class="rounded-lg border border-gray-700 px-4 py-2 text-sm text-gray-300 hover:border-gray-500">Cancel</button>
                <button type="submit"
                    class="rounded-lg bg-[#E50914] px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Save</button>
            </div>
        </form>
    </div>

    {{-- UNUSED TICKETS --}}
    <div class="mb-8">
        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Unused Tickets</h3>
        @if($unusedTickets->isEmpty())
        <div class="bg-[#1a1a1a] rounded-2xl p-8 text-center">
            <div class="text-5xl mb-3">🎟</div>
            <p class="text-gray-500 text-xs uppercase tracking-widest mb-4">You currently do not have any tickets</p>
            <a href="{{ url('/') }}" class="bg-[#E50914] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-full text-sm transition">
                Buy Tickets
            </a>
        </div>
        @else
        <div class="space-y-3">
            @foreach($unusedTickets as $ticket)
            <div class="bg-[#1a1a1a] rounded-2xl p-4 flex items-center gap-4">
                <img src="{{ $ticket->poster ? asset('uploads/'.$ticket->poster) : 'https://via.placeholder.com/48x64?text=?' }}"
                     class="w-12 h-16 rounded-lg object-cover flex-shrink-0">
                <div class="flex-1">
                    <p class="font-bold text-white">{{ $ticket->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($ticket->start_time)->format('D, d M Y · H:i') }}</p>
                    @if($ticket->seats)<p class="text-xs text-yellow-400 mt-0.5">Seats: {{ $ticket->seats }}</p>@endif
                </div>
                <span class="font-black text-yellow-400">${{ number_format($ticket->total_price, 2) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-4 text-center mb-8 bg-[#1a1a1a] rounded-2xl py-5">
        <div>
            <span class="material-icons text-[#E50914] text-2xl block mb-1">confirmation_number</span>
            <p class="text-xl font-black">{{ $totalTickets }}</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Tickets</p>
        </div>
        <div>
            <span class="material-icons text-[#E50914] text-2xl block mb-1">visibility</span>
            <p class="text-xl font-black">{{ $totalTickets }}</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Watched</p>
        </div>
        <div>
            <span class="material-icons text-[#E50914] text-2xl block mb-1">star</span>
            <p class="text-xl font-black">0</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Rated</p>
        </div>
        <div>
            <span class="material-icons text-[#E50914] text-2xl block mb-1">chat_bubble</span>
            <p class="text-xl font-black">0</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Comment</p>
        </div>
    </div>

    {{-- RECENTLY WATCHED --}}
    <div class="mb-8">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Recently Watched Movies</h3>
            <a href="{{ route('tickets.my') }}" class="text-xs text-gray-400 hover:text-white uppercase tracking-widest">View More</a>
        </div>
        @if($recentlyWatched->isEmpty())
        <p class="text-gray-600 text-sm">No movies watched yet.</p>
        @else
        <div class="flex gap-3 overflow-x-auto pb-2" style="scrollbar-width:none">
            @foreach($recentlyWatched as $movie)
            <div class="flex-shrink-0 w-32">
                <img src="{{ $movie->poster ? asset('uploads/'.$movie->poster) : 'https://via.placeholder.com/128x180?text=?' }}"
                     class="w-32 h-44 rounded-2xl object-cover">
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>

@include('components.footer')

<script>
document.getElementById('editProfileBtn')?.addEventListener('click', () => {
    document.getElementById('editProfileForm').classList.toggle('hidden');
    document.getElementById('editProfileForm').scrollIntoView({ behavior: 'smooth' });
});
document.getElementById('cancelEditBtn')?.addEventListener('click', () => {
    document.getElementById('editProfileForm').classList.add('hidden');
});
document.getElementById('customer_avatar')?.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (ev) => { document.getElementById('profileAvatarImg').src = ev.target.result; };
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
