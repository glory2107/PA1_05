@extends('layouts.guest.app')

@section('title', 'Struktur Organisasi Sekolah')

@section('content')
    <div class="container-fluid titleArtikel py-4 text-center" style="margin-top: 40px; max-width: 1140px;">
        <div class="line-container">
            <hr class="solid-line">
            <h1 style="color: #003366; font-size: 2rem; font-weight: bold; display: inline-block; margin-bottom: 10px;">STRUKTUR ORGANISASI SEKOLAH</h1>
            <hr class="solid-line">
        </div>
    </div>

    <div class="container py-10"> <!-- Reduced padding here -->
        <div class="row mb-3"> <!-- Reduced margin here -->
            <div class="col-12 text-center">
                <p class="text-muted">Tahun Ajaran 2024/2025</p>
            </div>
        </div>

        <!-- Daftar Struktur Organisasi -->
        <div class="row justify-content-center">
            @forelse ($strukturorganisasi as $struktur)
                <div class="col-md-12 text-center mb-4">
                    <!-- Menampilkan Gambar Struktur Organisasi -->
                    @if ($struktur->image)
                        <img src="{{ asset('storage/' . $struktur->image) }}" alt="Struktur Organisasi" style="max-width: 100%; height: auto;">
                    @else
                        <img src="https://via.placeholder.com/600x400?text=No+Image" alt="No Image Available" style="max-width: 100%; height: auto;">
                    @endif

                    <!-- Menampilkan Nama Posisi -->
                    <h5 class="mt-3">{{ $struktur->nama }}</h5>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Tidak ada data Struktur Organisasi yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

<style>
    .solid-line {
        border-top: 2px solid #003366;
        width: 100px;
        margin: 0 10px;
        display: inline-block;
        vertical-align: middle;
    }
</style>
