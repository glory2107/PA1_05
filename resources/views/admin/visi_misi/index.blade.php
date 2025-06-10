@extends('layouts.admin.app')

@section('title', 'Visi Misi')

@section('content')
<div class="container px-6 mx-auto grid">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Visi Misi</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Kelola informasi visi misi Anda</p>
        </div>
        <a href="{{ route('admin.profil-sekolah.create') }}"
           class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-purple-600 rounded-lg shadow hover:bg-purple-700 transition-colors focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Visi & Misi Baru
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

    <!-- Profile Cards -->
    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($profils as $profil)
        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white break-words">
                    {{ $profil->title }}
                </h3>
            </div>

            <!-- Card Image -->
            <div class="relative overflow-hidden aspect-video">
                @if ($profil->image)
                <img src="{{ asset('storage/' . $profil->image) }}" alt="Gambar {{ $profil->title }}"
                     class="object-cover w-full h-full transition-transform duration-300 hover:scale-105">
                @else
                <div class="flex items-center justify-center w-full h-full bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500">
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm">Tidak Ada Gambar</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Card Body -->
            <div class="p-6 flex-grow">
                <div class="description-container">
                    <div class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        {!! Str::limit($profil->description, 120) !!}
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600 flex justify-end gap-4">
                <!-- Edit Button -->
                <a href="{{ route('admin.profil-sekolah.edit', $profil->id) }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-gray-600 dark:text-blue-300 dark:hover:bg-gray-500 transition-colors mr-4">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                
                <!-- Delete Button -->
                <form id="delete-form-{{ $profil->id }}" action="{{ route('admin.profil-sekolah.destroy', $profil->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $profil->id }})"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200 dark:bg-gray-600 dark:text-red-300 dark:hover:bg-gray-500 transition-colors">
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
                <p class="text-gray-600 dark:text-gray-400 text-lg">Belum ada data visi misi yang tersedia.</p>
                <a href="{{ route('admin.profil-sekolah.create') }}"
                   class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    Tambah Visi Misi Pertama
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
</style>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus visi misi ini?',
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
