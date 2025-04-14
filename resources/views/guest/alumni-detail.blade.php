@extends('layouts.guest.app')

@section('title', 'Detail Alumni - ' . $alumni->name)

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="titleAlumni text-center mb-4">{{ $alumni->name }}</h3>

    {{-- Gambar utama --}}
    @if ($alumni->image)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $alumni->image) }}" alt="{{ $alumni->name }}" 
                 class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
        </div>
    @endif

    {{-- Deskripsi --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tentang Alumni</h5>
            {{-- Optional: tambahkan informasi waktu --}}
            <small class="text-muted">
                <i class="fas fa-user-graduate"></i> Alumni Terdaftar
            </small>
        </div>
        <div class="card-body">
            <div class="text-justify">
                {!! $alumni->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
