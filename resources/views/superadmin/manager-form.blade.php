@extends('superadmin.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-black text-white">{{ isset($manager) ? 'Edit Manager' : 'Add Manager' }}</h2>
    <a href="/superadmin/managers" class="text-gray-400 hover:text-white text-sm">← Back</a>
</div>

<form action="{{ isset($manager) ? '/superadmin/managers/'.$manager->customer_id : '/superadmin/managers' }}"
      method="POST" class="grid grid-cols-2 gap-6">
    @csrf
    @if(isset($manager)) @method('PUT') @endif

    {{-- LEFT: Info --}}
    <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-6 space-y-4">

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-3">
            @foreach($errors->all() as $e)
                <p class="text-red-400 text-xs">{{ $e }}</p>
            @endforeach
        </div>
        @endif

        <div>
            <label class="text-xs text-gray-400 block mb-1">Full Name</label>
            <input type="text" name="name" value="{{ $manager->customer_name ?? old('name') }}"
                class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
        </div>
        <div>
            <label class="text-xs text-gray-400 block mb-1">Email</label>
            <input type="email" name="email" value="{{ $manager->customer_email ?? old('email') }}"
                class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
        </div>
        <div>
            <label class="text-xs text-gray-400 block mb-1">Phone (optional)</label>
            <input type="text" name="phone" value="{{ $manager->customer_phone ?? old('phone') }}"
                class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
        </div>
        <div>
            <label class="text-xs text-gray-400 block mb-1">
                Password @if(isset($manager))<span class="text-gray-600">(leave blank to keep current)</span>@endif
            </label>
            <input type="password" name="password" placeholder="••••••••"
                class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none"
                {{ isset($manager) ? '' : 'required' }}>
            @if(isset($manager))
            <p class="text-xs text-gray-600 mt-1">Leave empty to keep existing password</p>
            @endif
        </div>
        @if(isset($manager))
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ $manager->is_active ? 'checked' : '' }} class="accent-yellow-400">
            <span class="text-sm text-gray-300">Active</span>
        </label>
        @endif
        <button type="submit"
            class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-2 rounded-lg transition">
            {{ isset($manager) ? 'Update Manager' : 'Create Manager' }}
        </button>
    </div>

    {{-- RIGHT: Permissions (inside same form) --}}
    <div class="bg-[#0d1117] border border-gray-800 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-2">Permissions</h3>
        <p class="text-xs text-gray-500 mb-4">Select modules this manager can access</p>
        <div class="space-y-3">
            @foreach($modules as $key => $label)
            @php $checked = isset($manager) && in_array($key, is_string($manager->permissions) ? json_decode($manager->permissions, true) : (array)($manager->permissions ?? [])); @endphp
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" name="permissions[]" value="{{ $key }}"
                    {{ $checked ? 'checked' : '' }}
                    class="w-4 h-4 accent-yellow-400">
                <span class="text-sm text-gray-300 group-hover:text-white transition">{{ $label }}</span>
            </label>
            @endforeach
        </div>
        <div class="mt-4 pt-4 border-t border-gray-800 flex gap-2">
            <button type="button" onclick="document.querySelectorAll('[name=\'permissions[]\']').forEach(c=>c.checked=true)"
                class="text-xs text-yellow-400 hover:underline">Select All</button>
            <span class="text-gray-700">|</span>
            <button type="button" onclick="document.querySelectorAll('[name=\'permissions[]\']').forEach(c=>c.checked=false)"
                class="text-xs text-gray-400 hover:underline">Clear All</button>
        </div>
    </div>

</form>

@endsection
