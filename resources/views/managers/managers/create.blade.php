@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Add Manager</h2>
    <a href="{{ route('admin.managers.index') }}" class="text-gray-400 hover:text-white text-sm">← Back</a>
</div>

<div class="grid grid-cols-2 gap-6">
    <div class="bg-[#11161c] rounded-2xl p-6">
        <form action="{{ route('admin.managers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs text-gray-400 block mb-1">Full Name</label>
                 <input type="text" name="customer_name" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
            </div>
            <div>
                <label class="text-xs text-gray-400 block mb-1">Email</label>
                 <input type="email" name="customer_email" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
            </div>
            <div>
                <label class="text-xs text-gray-400 block mb-1">Phone</label>
                 <input type="text" name="customer_phone" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none">
            </div>
            <div>
                <label class="text-xs text-gray-400 block mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none" required>
            </div>
            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-2 rounded-lg transition">Create Manager</button>
        </form>
    </div>

    <div class="bg-[#11161c] rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Permissions</h3>
        <p class="text-xs text-gray-500 mb-4">Select which modules this manager can access</p>
        <form id="permForm">
        <div class="space-y-3">
            @foreach($modules as $key => $label)
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" name="permissions[]" value="{{ $key }}" form="mainForm"
                    class="w-4 h-4 accent-yellow-400 rounded">
                <span class="text-sm text-gray-300 group-hover:text-white transition">{{ $label }}</span>
            </label>
            @endforeach
        </div>
        </form>
        <p class="text-xs text-gray-600 mt-4">Note: Dashboard is always accessible.</p>
    </div>
</div>

<script>
// Link checkboxes to main form
document.querySelector('form[action="{{ route('admin.managers.store') }}"]').id = 'mainForm';
</script>

@endsection
