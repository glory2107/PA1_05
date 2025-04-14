@extends('layouts.guest.app')

@section('title', 'Detail Ekstrakurikuler - ' . $ekstrakurikuler->name)

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="titleEkstrakurikuler text-center mb-4">{{ $ekstrakurikuler->name }}</h3>

    {{-- Gambar utama --}}
    @if ($ekstrakurikuler->image)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $ekstrakurikuler->image) }}" alt="{{ $ekstrakurikuler->name }}" 
                 class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
        </div>
    @endif

    {{-- Deskripsi --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tentang Ekstrakurikuler</h5>
        </div>
        <div class="card-body">
            <div class="text-justify">
                {!! nl2br(e($ekstrakurikuler->description)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
