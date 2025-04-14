@extends('layouts.guest.app')

@section('title', 'Fasilitas Sekolah')

@section('content')
<!-- Fasilitas -->
<div class="jurusan">
    <div class="container">
        <h2>Fasilitas</h2>

        <div class="boxJurusan">
            @forelse ($fasilitas as $item)
                <div class="perBox">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                        <img src="{{ asset('guest/images/default.jpg') }}" alt="Fasilitas Default">
                    @endif
                    <h3>{{ $item->title }}</h3>
                </div>
            @empty
                <p class="text-center text-gray-600">Belum ada data fasilitas sekolah yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
