@extends('layouts.guest.app')

@section('title', 'Detail Event - ' . $event->name)

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="titleEvent text-center mb-4">{{ $event->name }}</h3>

    {{-- Gambar utama --}}
    @if ($event->image)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" 
                 class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
        </div>
    @endif

    {{-- Deskripsi --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Deskripsi Event</h5>
            <small class="text-muted">
                <i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
            </small>
        </div>
        <div class="card-body">
            <div class="text-justify">
                {!! $event->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
