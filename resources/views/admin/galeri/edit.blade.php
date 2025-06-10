@extends('layouts.admin.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Edit Galeri</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Perbarui informasi galeri Anda</p>
        </div>
        <a href="{{ route('admin.galeri.index') }}"
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
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">Formulir Edit Galeri</h3>
        </div>

        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="p-6" id="galeriForm">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Judul Galeri <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $galeri->title) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <!-- Deskripsi dengan CKEditor -->
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Deskripsi Galeri <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="8"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $galeri->description) }}</textarea>
                <input type="hidden" name="description_content" id="description_content">
            </div>

            <!-- Cover -->
            <div class="mb-6">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Gambar Cover
                </label>
                @if ($galeri->image)
                    <div class="mb-4 relative group">
                        <img src="{{ asset('storage/' . $galeri->image) }}" alt="Cover Saat Ini" class="w-32 h-32 object-cover rounded border">
                        <div class="mt-2 flex items-center">
                            <input type="checkbox" id="remove_cover" name="remove_cover" class="mr-2" value="1">
                            <label for="remove_cover" class="text-sm text-gray-600 dark:text-gray-400">Hapus gambar cover saat ini</label>
                        </div>
                        <input type="hidden" name="current_image" value="{{ $galeri->image }}">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-gray-700 dark:file:text-purple-300 dark:text-gray-400">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload gambar baru untuk menggantikan gambar saat ini</p>
            </div>

            <!-- Banyak Gambar -->
            <div class="mb-6">
                <label for="images" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Gambar-Gambar Galeri
                </label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-gray-700 dark:file:text-purple-300 dark:text-gray-400">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload gambar baru untuk ditambahkan ke galeri</p>
            </div>

            <!-- Preview Gambar Lama dengan opsi hapus -->
            @if ($galeri->images)
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Gambar Galeri Sebelumnya:
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="gallery-images">
                        @foreach (json_decode($galeri->images, true) as $index => $img)
                            <div class="relative group" id="image-container-{{ $index }}">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-32 object-cover rounded shadow border">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-100 transition-opacity">
                                        <button type="button" class="remove-image p-1 bg-red-600 text-white rounded-full" data-index="{{ $index }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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

            <!-- Tanggal -->
            <div class="mb-6">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tanggal Galeri <span class="text-red-500">*</span>
                </label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $galeri->tanggal) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <!-- Aksi -->
            <div class="flex items-center justify-end space-x-4 mt-6">
                <a href="{{ route('admin.galeri.index') }}"
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

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let editorInstance;
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editorInstance = editor;
                const initialData = document.querySelector('#description').value;
                if (initialData) {
                    editor.setData(initialData);
                }
                editor.model.document.on('change:data', () => {
                    document.getElementById('description_content').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });

        const imagesToRemove = [];

        document.querySelectorAll('.remove-image').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                const container = document.getElementById('image-container-' + index);
                const keepInput = document.getElementById('keep-image-' + index);

                
                imagesToRemove.push(keepInput.value);
               
                document.getElementById('remove_images').value = JSON.stringify(imagesToRemove);

                
                container.style.display = 'none';
                keepInput.disabled = true;
            });
        });


        document.getElementById('images').addEventListener('change', function() {
            imagesToRemove.length = 0;
            document.getElementById('remove_images').value = '';
        });

        document.getElementById('image').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const coverCheckbox = document.getElementById('remove_cover');
                if (coverCheckbox) {
                    coverCheckbox.checked = true;
                }
            }
        });

        // Validasi form jika deskripsi kosong
        document.getElementById('galeriForm').addEventListener('submit', function(e) {
            if (editorInstance) {
                const content = editorInstance.getData();
                document.getElementById('description_content').value = content;
                if (!content.trim()) {
                    e.preventDefault();
                    alert("Deskripsi tidak boleh kosong.");
                }
            }
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
