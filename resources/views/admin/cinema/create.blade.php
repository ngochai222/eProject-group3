@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Add New Cinema</h2>
    <a href="{{ route('admin.cinemas.index') }}" class="text-gray-400 hover:text-white text-sm transition">← Back</a>
</div>

<form action="{{ route('admin.cinemas.store') }}" method="POST" enctype="multipart/form-data" id="cinemaForm">
@csrf

<div class="grid grid-cols-3 gap-6">

    {{-- FORM --}}
    <div class="col-span-2 bg-[#11161c] p-6 rounded-2xl space-y-5">

        <div>
            <label class="text-sm text-gray-400">Cinema Name</label>
            <input type="text" name="cinema_name" placeholder="Enter cinema name"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                oninput="updatePreview()" required>
        </div>

        <div>
            <label class="text-sm text-gray-400">Address</label>
            <input type="text" name="cinema_address" placeholder="Street, City..."
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                oninput="updatePreview()">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-400">Number of Screens</label>
                <input type="number" name="screens" placeholder="5" min="1"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    oninput="updatePreview()">
            </div>
            <div>
                <label class="text-sm text-gray-400">Seat Capacity</label>
                <input type="number" name="capacity" placeholder="120" min="1"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    oninput="updatePreview()">
            </div>
        </div>

        <div>
            <label class="text-sm text-gray-400">Cinema Type</label>
            <select name="cinema_type"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                onchange="updatePreview()">
                <option value="IMAX">IMAX</option>
                <option value="Dolby Cinema">Dolby Cinema</option>
                <option value="Standard">Standard</option>
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-400">Status</label>
            <select name="status"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                onchange="updatePreview()">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-400">Image</label>
            <input type="file" name="cinema_image" accept="image/*"
                class="w-full mt-2 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-yellow-400 file:text-black file:font-semibold hover:file:bg-yellow-300"
                onchange="previewImage(event)">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.cinemas.index') }}"
               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded text-white transition">Cancel</a>
            <button type="submit"
               class="px-6 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded font-semibold transition">
                Save Cinema
            </button>
        </div>
    </div>

    {{-- PREVIEW --}}
    <div class="bg-[#11161c] p-6 rounded-2xl">
        <h3 class="font-semibold text-white mb-4">Preview</h3>

        <div class="bg-black p-4 rounded-xl space-y-3">
            <div class="w-full h-32 bg-gray-800 rounded overflow-hidden flex items-center justify-center">
                <img id="previewImg" src="" class="w-full h-full object-cover hidden">
                <span id="previewImgPlaceholder" class="text-gray-600 text-sm">No image</span>
            </div>

            <h3 id="previewName" class="font-semibold text-white">Cinema Name</h3>

            <p id="previewAddress" class="text-xs text-gray-400">Address, City</p>

            <div class="flex gap-2 text-xs flex-wrap">
                <span id="previewType" class="bg-yellow-400 text-black px-2 py-1 rounded font-bold">IMAX</span>
                <span id="previewScreens" class="bg-gray-700 text-white px-2 py-1 rounded">— Screens</span>
            </div>

            <p id="previewCapacity" class="text-sm text-gray-300">Seats: —</p>

            <span id="previewStatus" class="text-green-400 text-xs">● Active</span>
        </div>
    </div>

</div>
</form>

<script>
function previewImage(event) {
    const img = document.getElementById('previewImg');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.classList.remove('hidden');
    document.getElementById('previewImgPlaceholder').classList.add('hidden');
}

function updatePreview() {
    const name     = document.querySelector('[name=cinema_name]').value || 'Cinema Name';
    const address  = document.querySelector('[name=cinema_address]').value || 'Address, City';
    const screens  = document.querySelector('[name=screens]').value || '—';
    const capacity = document.querySelector('[name=capacity]').value || '—';
    const type     = document.querySelector('[name=cinema_type]').value;
    const status   = document.querySelector('[name=status]').value;

    document.getElementById('previewName').textContent     = name;
    document.getElementById('previewAddress').textContent  = address;
    document.getElementById('previewType').textContent     = type;
    document.getElementById('previewScreens').textContent  = screens + ' Screens';
    document.getElementById('previewCapacity').textContent = 'Seats: ' + capacity;

    const statusEl = document.getElementById('previewStatus');
    statusEl.textContent = '● ' + status;
    statusEl.className = status === 'Active' ? 'text-green-400 text-xs' : 'text-gray-500 text-xs';
}
</script>

@endsection
