@extends('layouts.admin.app') 

@section('title', 'Daftar Pengumuman')

@section('content')

<div class="container px-6 mx-auto grid">

<!-- Header -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
    <div>
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Daftar Pengumuman</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-400">Kelola informasi dan pengumuman sekolah</p>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}"
       class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-purple-600 rounded-lg shadow hover:bg-purple-700 transition-colors focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Tambah Pengumuman
    </a>
</div>

<!-- Alert -->
@if (session('success'))
<div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500 dark:bg-gray-800 dark:text-green-400 dark:border-green-500 flex items-center animate-pulse">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    {{ session('success') }}
</div>
@endif

<!-- Pengumuman Cards -->
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($pengumuman as $item)
    <div class="overflow-hidden bg-white rounded-xl shadow-md dark:bg-gray-800 hover:shadow-xl transition-all duration-300 flex flex-col">
        
        <!-- Card Header -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white truncate">{{ $item->title }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-300">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
        </div>

        <!-- Card Image -->
        @if ($item->image)
        <div class="relative overflow-hidden" style="height: 200px;">
            <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar {{ $item->title }}"
                 class="object-cover w-full h-full transition-transform duration-300 hover:scale-105">
        </div>
        @endif

        <!-- Card Content -->
        <div class="p-6 flex-grow">
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                Status: <span class="font-medium capitalize">{{ $item->status }}</span>
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                {!! nl2br(strip_tags($item->description, '<strong><b><i><u><p><br>')) !!}
            </p>

            @if ($item->file)
            <div class="mt-4">
                <p class="text-sm text-gray-700 dark:text-gray-300 font-semibold mb-1">Lampiran:</p>
                @php
                    $extension = pathinfo($item->file, PATHINFO_EXTENSION);
                @endphp

                @if ($extension === 'pdf')
                    <iframe src="{{ asset('storage/' . $item->file) }}" class="w-full h-48 rounded border border-gray-300 dark:border-gray-600" frameborder="0"></iframe>
                @else
                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                       class="inline-flex items-center mt-1 px-3 py-1 text-sm text-blue-600 bg-blue-100 rounded hover:bg-blue-200 dark:bg-gray-700 dark:text-blue-300 dark:hover:bg-gray-600 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Lihat / Unduh File ({{ strtoupper($extension) }})
                    </a>
                @endif
            </div>
            @endif
        </div>

        <!-- Card Footer -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-end gap-4">
            <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
               class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-gray-600 dark:text-blue-300 dark:hover:bg-gray-500 transition mr-3">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $item->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200 dark:bg-gray-600 dark:text-red-300 dark:hover:bg-gray-500 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
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
            <p class="text-gray-600 dark:text-gray-400 text-lg">Belum ada data pengumuman yang tersedia.</p>
            <a href="{{ route('admin.pengumuman.create') }}"
               class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                Tambah Pengumuman Pertama
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
</style>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus pengumuman ini?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
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
