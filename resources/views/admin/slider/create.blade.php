@extends('layouts.admin.app')

@section('title', 'Tambah Slider')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                Tambah Slider
            </h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Unggah gambar untuk slider baru</p>
        </div>
        <a href="{{ route('admin.slider.index') }}"
           class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white transition-colors duration-200 bg-purple-600 border border-purple-700 rounded-lg shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
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
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                Upload Gambar Slider
            </h3>
        </div>

        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- Multiple Images -->
            <div class="mb-6">
                <label for="images" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Gambar Slider <span class="text-red-500">*</span>
                </label>
                <input type="file" id="images" name="images[]" accept="image/*" multiple
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-gray-700 dark:file:text-purple-300 dark:text-gray-400" required>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload lebih dari satu gambar dengan menekan <kbd>Ctrl</kbd> / <kbd>Cmd</kbd> saat memilih file.
                </p>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4 mt-6">
                <a href="{{ route('admin.slider.index') }}"
                   class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200 dark:bg-gray-600 dark:text-red-300 dark:hover:bg-gray-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-gray-600 dark:text-blue-300 dark:hover:bg-gray-500 transition-colors">
                    Simpan
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
