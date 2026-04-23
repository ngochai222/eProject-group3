@extends('managers.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Edit Cinema</h2>
    <a href="{{ route('admin.cinemas.index') }}" class="text-gray-400 hover:text-white text-sm transition">← Back</a>
</div>

<form action="{{ route('admin.cinemas.update', $cinema->cinema_id) }}" method="POST" enctype="multipart/form-data" id="cinemaForm">
@csrf @method('PUT')

<div class="grid grid-cols-3 gap-6">

    {{-- FORM --}}
    <div class="col-span-2 bg-[#11161c] p-6 rounded-2xl space-y-5">

        <div>
            <label class="text-sm text-gray-400">Cinema Name</label>
            <input type="text" name="cinema_name" value="{{ $cinema->cinema_name }}"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                oninput="updatePreview()" required>
        </div>

        <div>
            <label class="text-sm text-gray-400">Address</label>
            <input type="text" name="cinema_address" value="{{ $cinema->cinema_address }}"
                class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                oninput="updatePreview()">
        </div>

        <div>
            <label class="text-sm text-gray-400">Image (leave empty to keep current)</label>
            @if($cinema->cinema_image)
                <div class="mt-2 mb-2">
                    <img src="{{ asset('uploads/'.$cinema->cinema_image) }}" class="h-20 rounded object-cover">
                </div>
            @endif
            <input type="file" name="cinema_image" accept="image/*"
                class="w-full mt-1 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-yellow-400 file:text-black file:font-semibold hover:file:bg-yellow-300"
                onchange="previewImage(event)">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.cinemas.index') }}"
               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded text-white transition">Cancel</a>
            <button type="submit"
               class="px-6 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded font-semibold transition">
                Update Cinema
            </button>
        </div>
    </div>

    {{-- PREVIEW --}}
    <div class="bg-[#11161c] p-6 rounded-2xl">
        <h3 class="font-semibold text-white mb-4">Preview</h3>

        <div class="bg-black p-4 rounded-xl space-y-3">
            <div class="w-full h-32 bg-gray-800 rounded overflow-hidden flex items-center justify-center">
                @if($cinema->cinema_image)
                    <img id="previewImg" src="{{ asset('uploads/'.$cinema->cinema_image) }}" class="w-full h-full object-cover">
                @else
                    <img id="previewImg" src="" class="w-full h-full object-cover hidden">
                @endif
                <span id="previewImgPlaceholder" class="text-gray-600 text-sm {{ $cinema->cinema_image ? 'hidden' : '' }}">No image</span>
            </div>

            <h3 id="previewName" class="font-semibold text-white uppercase">{{ $cinema->cinema_name }}</h3>
            <p id="previewAddress" class="text-xs text-gray-400">{{ $cinema->cinema_address }}</p>
            <span class="text-green-400 text-xs">● Active</span>
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
    document.getElementById('previewName').textContent    = document.querySelector('[name=cinema_name]').value || 'Cinema Name';
    document.getElementById('previewAddress').textContent = document.querySelector('[name=cinema_address]').value || 'Address';
}
</script>

@endsection
