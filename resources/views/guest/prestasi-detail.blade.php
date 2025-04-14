@extends('layouts.guest.app')

@section('title', 'Detail Prestasi - ' . $prestasi->title)

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="titlePrestasi text-center mb-4">{{ $prestasi->title }}</h3>

    {{-- Gambar utama --}}
    @if ($prestasi->image)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" 
                 class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
        </div>
    @endif

    {{-- Deskripsi --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Deskripsi Prestasi</h5>
            <small class="text-muted">
                <i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d F Y') }}
            </small>
        </div>
        <div class="card-body">
            <div class="text-justify">
                {!! $prestasi->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
