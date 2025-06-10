@extends('layouts.admin.app')

@section('title', 'Edit Slider')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Edit Slider</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Perbarui gambar slider Anda</p>
        </div>
        <a href="{{ route('admin.slider.index') }}"
           class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-purple-600 border border-purple-700 rounded-lg shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg border-l-4 border-red-500 dark:bg-gray-800 dark:text-red-400 dark:border-red-500">
            <div class="font-medium">Terdapat kesalahan pada data yang dimasukkan:</div>
            <ul class="mt-1 ml-4 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md dark:bg-gray-800 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">Formulir Edit Slider</h3>
        </div>

        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="p-6" id="sliderForm">
            @csrf
            @method('PUT')

            <!-- Upload Gambar Baru (Multiple) -->
            <div class="mb-6">
                <label for="images" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Unggah Gambar Baru untuk Slider
                </label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-gray-700 dark:file:text-purple-300 dark:text-gray-400">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload gambar baru untuk ditambahkan ke slider. Bisa pilih lebih dari satu gambar.
                </p>
            </div>

            <!-- Preview Gambar Lama dengan opsi hapus -->
            @if ($slider->images && is_array($slider->images) && count($slider->images) > 0)
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Gambar Slider Saat Ini:
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="slider-images">
                        @foreach ($slider->images as $index => $img)
                            <div class="relative group" id="image-container-{{ $index }}">
                                <div class="relative">
                                    <img src="{{ asset('storage/guest/images/' . $img) }}" class="w-full h-32 object-cover rounded shadow border" alt="Gambar Slider">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-100 transition-opacity">
                                        <button type="button" class="remove-image p-1 bg-red-600 text-white rounded-full" data-index="{{ $index }}" aria-label="Hapus gambar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="keep_images[]" value="{{ $img }}" id="keep-image-{{ $index }}">
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Arahkan kursor ke gambar dan klik ikon silang untuk menghapus gambar</p>
                    <input type="hidden" name="remove_images" id="remove_images" value="">
                </div>
            @endif

            <!-- Submit & Cancel -->
            <div class="flex items-center justify-end space-x-4 mt-6">
                <a href="{{ route('admin.slider.index') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" id="submitButton"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-700 dark:hover:bg-blue-800 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imagesToRemove = [];

    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            const container = document.getElementById('image-container-' + index);
            const keepInput = document.getElementById('keep-image-' + index);

            // Tambahkan nama gambar ke array hapus
            imagesToRemove.push(keepInput.value);
            // Update input hidden dengan JSON string
            document.getElementById('remove_images').value = JSON.stringify(imagesToRemove);

            container.style.display = 'none';
            keepInput.disabled = true;
        });
    });


    document.getElementById('images').addEventListener('change', function() {
        imagesToRemove.length = 0;
        document.getElementById('remove_images').value = '';
    });
});
</script>

<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.group:hover .remove-image {
    opacity: 1 !important;
    visibility: visible !important;
}
.remove-image {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
}
</style>
@endsection