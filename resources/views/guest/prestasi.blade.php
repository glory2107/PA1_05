@extends('layouts.guest.app')   

@section('title', 'Prestasi')

@section('content')
<div class="container titleArtikel py-4 text-center" style="margin-top: 0px;">
    <!-- Garis horizontal biasa di kiri dan kanan judul -->
    <div class="line-container">
        <hr class="solid-line">
        <h1 style="color: #003366; font-size: 2rem; font-weight: bold; display: inline-block;">PRESTASI</h1>
        <hr class="solid-line">
    </div>
</div>

<div class="container artikel">
    @forelse ($prestasi as $item)
        <a href="{{ route('guest.prestasi.detail', $item->id) }}" class="text-decoration-none">
            <div class="perArtikel mb-3 p-3 border rounded shadow-lg zoom-effect">  
                {{-- Gambar --}}
                <img 
                    src="{{ $item->image ? asset('storage/' . $item->image) : asset('guest/images/default.jpg') }}" 
                    alt="Prestasi {{ $item->title }}"
                    class="img-fluid mb-3"
                    style="max-width: 100%; height: auto; object-fit: cover; border-radius: 8px;"
                >

                {{-- Konten --}}
                <div class="textArtikel">
                    {{-- Judul --}}
                    <h3 class="prestasi-title text-dark mb-2" style="font-size: 1.2rem; font-weight: 500; text-transform: uppercase;">
                        {{ $item->title }}
                    </h3>

                    {{-- Tanggal + Ikon --}}
                    <p class="text-muted mb-2">
                        <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M, Y') }}
                    </p>

                    {{-- Garis Horizontal --}}
                    <hr class="my-2">

                    {{-- Deskripsi --}}
                    <p class="text-muted mb-3">
                        <i class="bi bi-person-circle"></i> {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 150, '...') }}
                    </p>

                    {{-- Peserta --}}
                    @if ($item->peserta)
                        <p class="text-muted mt-2">
                            <i class="bi bi-person-fill"></i> : {{ $item->peserta }}
                        </p>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <p class="text-center text-muted">Belum ada data prestasi tersedia.</p>
    @endforelse
</div>
@endsection

<style>

.zoom-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.zoom-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}


.prestasi-title:hover {
    color: #007bff !important;
}


.line-container {
    display: flex;
    align-items: center;
    justify-content: center;
}


.solid-line {
    width: 100px;
    border: none;
    border-top: 2px solid #003366;
    margin: 0 1px; 
    margin-top: 10px;
}

h1 {
    display: inline-block;
    padding: 0 15px;
}


.page-wrapper-prestasi {
    background-color: #f2f2f2;
    padding-top: 20px;
    padding-bottom: 20px;
    min-height: 100vh;
}


.prestasi-title {
    font-size: 1.3rem !important; 
    font-weight: 550 !important; 
    text-transform: uppercase;
    margin-bottom: 10px;
}
</style>
