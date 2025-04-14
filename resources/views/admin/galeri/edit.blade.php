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

        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
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

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Deskripsi Galeri <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="8"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                          required>{{ old('description', $galeri->description) }}</textarea>
            </div>

            <!-- Cover -->
            <div class="mb-6">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Gambar Cover (Opsional)
                </label>
                @if ($galeri->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $galeri->image) }}" alt="Cover Saat Ini" class="w-32 h-32 object-cover">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-gray-700 dark:file:text-purple-300 dark:text-gray-400">
            </div>

            <!-- Banyak Gambar -->
            <div class="mb-6">
                <label for="images" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tambah Gambar Lainnya (Boleh Banyak)
                </label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-gray-700 dark:file:text-purple-300 dark:text-gray-400">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gambar-gambar tambahan untuk galeri. Bisa lebih dari satu file.</p>
            </div>

            <!-- Preview Gambar Lama -->
            @if ($galeri->images)
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Gambar Galeri Sebelumnya:
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach (json_decode($galeri->images, true) as $img)
                            <div>
                                <img src="{{ asset('storage/' . $img) }}" class="w-full h-32 object-cover rounded shadow">
                            </div>
                        @endforeach
                    </div>
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
                   class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200 dark:bg-gray-600 dark:text-red-300 dark:hover:bg-gray-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-gray-600 dark:text-blue-300 dark:hover:bg-gray-500 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
