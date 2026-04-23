@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Manager Profile</h2>
        <p class="text-sm text-gray-500 mt-1">Manage your account information</p>
    </div>
</div>

<div class="grid grid-cols-3 gap-6">

    {{-- Profile Card --}}
    <div class="bg-[#11161c] rounded-2xl p-6 text-center">
        @php
            $avatarSrc = $admin && $admin->avatar
                ? asset('uploads/'.$admin->avatar)
                : 'https://ui-avatars.com/api/?name='.urlencode($admin->name ?? 'Manager').'&background=E50914&color=fff&size=96';
            $isManager = session('manager_id') ? true : false;
        @endphp
        <img id="avatarPreview" src="{{ $avatarSrc }}"
             class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-[#E50914] mb-3">
        <h3 class="font-black text-white text-lg">{{ $admin->name ?? session('manager_name', 'Manager') }}</h3>
        <p class="text-gray-500 text-sm">{{ $admin->email ?? session('manager_email', '') }}</p>
        @if($admin && $admin->phone)
            <p class="text-gray-500 text-xs mt-1">{{ $admin->phone }}</p>
        @endif
        <div class="mt-4 inline-flex items-center gap-1 text-xs {{ $isManager ? 'text-cyan-400 bg-cyan-400/10' : 'text-green-400 bg-green-400/10' }} px-3 py-1 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full {{ $isManager ? 'bg-cyan-400' : 'bg-green-400' }}"></span>
            {{ $isManager ? 'Manager' : 'Administrator' }}
        </div>
    </div>

    {{-- Edit Form --}}
    <div class="col-span-2 bg-[#11161c] rounded-2xl p-6">
        <h3 class="font-bold text-white mb-5">Edit Information</h3>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-400 block mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ $admin->name ?? session('manager_name', '') }}"
                        class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
                </div>
                <div>
                    <label class="text-xs text-gray-400 block mb-1">Email</label>
                    <input type="email" name="email" value="{{ $admin->email ?? session('manager_email', '') }}"
                        class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-400 block mb-1">Phone</label>
                <input type="text" name="phone" value="{{ $admin->phone ?? '' }}"
                    class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
            </div>

            <div>
                <label class="text-xs text-gray-400 block mb-1">Avatar</label>
                <input type="file" name="avatar" accept="image/*"
                    class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-yellow-400 file:text-black file:font-semibold hover:file:bg-yellow-300"
                    onchange="previewAvatar(event)">
            </div>

            <hr class="border-gray-700 my-2">
            <p class="text-xs text-gray-500">Leave password blank to keep current</p>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-400 block mb-1">New Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none"
                        placeholder="••••••">
                </div>
                <div>
                    <label class="text-xs text-gray-400 block mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none"
                        placeholder="••••••">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-8 py-2 rounded-xl transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

</div>

<script>
function previewAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('avatarPreview').src = URL.createObjectURL(file);
    }
}
</script>

@endsection
