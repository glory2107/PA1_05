@extends('layouts.guest.app')

@section('title', 'Detail Pengumuman - ' . $pengumuman->title)

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="titlePengumuman text-center mb-4">{{ $pengumuman->title }}</h3>

    {{-- Gambar opsional --}}
    @if ($pengumuman->image)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $pengumuman->image) }}" alt="{{ $pengumuman->title }}" 
                 class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
        </div>
    @endif

    {{-- Deskripsi Pengumuman --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Deskripsi Pengumuman</h5>
            <small class="text-muted">
                <i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
            </small>
        </div>
        <div class="card-body">
            <div class="text-justify">
                {!! $pengumuman->description !!}
            </div>

            {{-- Lampiran File --}}
            @if ($pengumuman->file)
                <hr>
                <p><strong>Lampiran:</strong></p>
                <a href="{{ asset('storage/' . $pengumuman->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-file-alt"></i> Lihat Dokumen
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
