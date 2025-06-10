@extends('layouts.admin.app')

@section('title', 'Tenaga Kerja')

@section('content')
<div class="container px-6 mx-auto grid">

    <!-- Header Section with Animation -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Tenaga Kerja</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Kelola daftar tenaga kerja sekolah</p>
        </div>
        <a href="{{ route('admin.tenaga-kerja.create') }}"
           class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white transition-colors duration-200 bg-purple-600 rounded-lg shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Tenaga Kerja
        </a>
    </div>

    <!-- Alert Message -->
    @if (session('success'))
    <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500 dark:bg-gray-800 dark:text-green-400 dark:border-green-500 flex items-center animate-pulse">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Tenaga Kerja Cards -->
    <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($tenagaKerja as $kerja)
        <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-xl transition-all duration-300 flex flex-col h-[450px]">
            <!-- Card Header - Fixed Height -->
            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600 h-[80px] flex flex-col justify-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">
                    {{ $kerja->name }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 truncate">{{ $kerja->jabatan }}</p>
            </div>

            <!-- Card Image - Fixed Height -->
<div class="relative overflow-hidden h-[200px] flex-shrink-0">
    @if ($kerja->image)
    <img src="{{ asset('storage/' . $kerja->image) }}" alt="Gambar {{ $kerja->name }}"
         class="object-cover w-full h-[200px] transition-transform duration-300 hover:scale-105"> <!-- Mengatur tinggi dan lebar yang sama -->
    @else
    <div class="flex items-center justify-center w-full h-[200px] bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500">
        Tidak Ada Gambar
    </div>
    @endif
</div>


            <!-- Card Content - Flexible Height -->
            <div class="p-6 flex-grow flex items-start">
                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed line-clamp-4">
                    {!! Str::limit($kerja->description, 120) !!}
                </p>    
            </div>

            <!-- Card Footer - Fixed Height -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600 flex justify-end gap-4 h-[70px] flex-shrink-0 items-center">
                <a href="{{ route('admin.tenaga-kerja.edit', $kerja->id) }}"
                   class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-gray-600 dark:text-blue-300 dark:hover:bg-gray-500 transition-colors mr-3">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form id="delete-form-{{ $kerja->id }}" action="{{ route('admin.tenaga-kerja.destroy', $kerja->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $kerja->id }})"
                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200 dark:bg-gray-600 dark:text-red-300 dark:hover:bg-gray-500 transition-colors">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full p-12 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <div class="flex flex-col items-center">
                <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-600 dark:text-gray-400 text-lg">Belum ada data tenaga kerja yang tersedia.</p>
                <a href="{{ route('admin.tenaga-kerja.create') }}" 
                   class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    Tambah Tenaga Kerja Pertama
                </a>
            </div>
        </div>
        @endforelse
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

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }

    
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus tenaga kerja ini?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection
