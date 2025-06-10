@extends('layouts.admin.app') 

@section('title', 'Alumni')

@section('content')
<div class="container px-6 mx-auto grid">

    <!-- Header Section with Animation -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 my-8 animate-fade-in">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Alumni</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Kelola data alumni yang telah lulus dari sekolah</p>
        </div>
        <a href="{{ route('admin.alumni.create') }}"
           class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-purple-600 border border-purple-700 rounded-lg shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition-colors mr-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Alumni
        </a>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
    <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500 dark:bg-gray-800 dark:text-green-400 dark:border-green-500 flex items-center animate-pulse">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Alumni Cards -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($alumni as $item)
        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-xl transition-all duration-300 flex flex-col h-[450px]">
            <!-- Card Header - Fixed Height -->
            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600 h-[80px] flex flex-col justify-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">
                    {{ $item->name }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->program_studi }}</p>
            </div>

            <!-- Card Image - Fixed Height -->
            <div class="relative overflow-hidden h-[200px] flex-shrink-0">
                @if ($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="Foto {{ $item->name }}"
                     class="object-cover w-full h-[200px] transition-transform duration-300 hover:scale-105">
                @else
                <div class="flex items-center justify-center w-full h-[200px] bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500">
                    Tidak Ada Gambar
                </div>
                @endif
            </div>

            <!-- Card Footer - Fixed Height -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600 flex justify-end gap-4 h-[70px] flex-shrink-0 items-center">
                <!-- Edit Button with margin-right for spacing -->
                <a href="{{ route('admin.alumni.edit', $item->id) }}"
                   class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-gray-600 dark:text-blue-300 dark:hover:bg-gray-500 transition-colors mr-3">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <!-- Delete Button -->
                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $item->id }})"
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 dark:text-gray-400 text-lg">Belum ada data alumni yang tersedia.</p>
                <a href="{{ route('admin.alumni.create') }}" 
                   class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    Tambah Alumni Pertama
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

    
    .grid {
        gap: 2rem;
    }
</style>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus alumni ini?',
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
