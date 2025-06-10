@extends('layouts.admin.app')

@section('title', 'Edit Kontak')

@section('content')
<div class="container px-6 mx-auto grid">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Edit Kontak</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Perbarui informasi kontak Anda</p>
        </div>
        <a href="{{ route('admin.kontak.index') }}"
           class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-purple-600 border border-purple-700 rounded-lg shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Alert Error -->
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

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md dark:bg-gray-800 overflow-hidden">
        <!-- Card Header -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">Formulir Edit Kontak</h3>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.kontak.update', $kontak->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- Icon (Select with preview) -->
            <div class="mb-6">
                <label for="icon" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Icon <span class="text-red-500">*</span>
                </label>
                <select id="icon" name="icon" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                    <option value="" disabled>Pilih Icon</option>
                    <option value="fab fa-whatsapp" {{ old('icon', $kontak->icon) == 'fab fa-whatsapp' ? 'selected' : '' }} data-icon="fab fa-whatsapp">Whatsapp</option>
                    <option value="fab fa-instagram" {{ old('icon', $kontak->icon) == 'fab fa-instagram' ? 'selected' : '' }} data-icon="fab fa-instagram">Instagram</option>
                    <option value="fab fa-facebook-f" {{ old('icon', $kontak->icon) == 'fab fa-facebook-f' ? 'selected' : '' }} data-icon="fab fa-facebook-f">Facebook</option>
                    <option value="fab fa-youtube" {{ old('icon', $kontak->icon) == 'fab fa-youtube' ? 'selected' : '' }} data-icon="fab fa-youtube">Youtube</option>
                    <option value="fas fa-envelope" {{ old('icon', $kontak->icon) == 'fas fa-envelope' ? 'selected' : '' }} data-icon="fas fa-envelope">Gmail</option>
                    <option value="fas fa-phone-alt" {{ old('icon', $kontak->icon) == 'fas fa-phone-alt' ? 'selected' : '' }} data-icon="fas fa-phone-alt">Telepon</option>
                    <option value="fas fa-road" {{ old('icon', $kontak->icon) == 'fas fa-road' ? 'selected' : '' }} data-icon="fas fa-road">Alamat</option>
                </select>

                <div id="iconPreview" class="mt-2 text-2xl text-purple-600">
                    @if(old('icon', $kontak->icon))
                        <i class="{{ old('icon', $kontak->icon) }}"></i>
                    @endif
                </div>
            </div>

            <!-- Value -->
            <div class="mb-6">
                <label for="value" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Value <span class="text-red-500">*</span>
                </label>
                <input type="text" id="value" name="value" value="{{ old('value', $kontak->value) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                       required>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                        required>
                    <option value="aktif" {{ $kontak->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $kontak->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 mt-6">
                <a href="{{ route('admin.kontak.index') }}"
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

<!-- Font Awesome CDN (hanya dimuat sekali jika belum ada) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Select2 CSS dan JS CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function formatIcon(option) {
        if (!option.id) { return option.text; }
        var iconClass = $(option.element).data('icon');
        if(iconClass) {
            return $('<span><i class="' + iconClass + '" style="margin-right: 8px;"></i>' + option.text + '</span>');
        }
        return option.text;
    }

    $('#icon').select2({
        templateResult: formatIcon,
        templateSelection: formatIcon,
        escapeMarkup: function(m) { return m; }
    });

    $('#icon').on('change', function() {
        var iconClass = $(this).find('option:selected').data('icon');
        if(iconClass) {
            $('#iconPreview').html('<i class="' + iconClass + '"></i>');
        } else {
            $('#iconPreview').html('');
        }
    });

    
    $('#icon').trigger('change');
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
</style>
@endsection
