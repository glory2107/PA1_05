@extends('layouts.guest.app')

@section('title', 'Prestasi')

@section('content')
<div class="container titleArtikel" style="margin-top: 80px;">
    <h1>Prestasi</h1>
</div>

<div class="container artikel">
    @forelse ($prestasi as $item)
        <a href="{{ route('guest.prestasi.detail', $item->id) }}" class="text-decoration-none">
            <div class="perArtikel mb-4">
                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('guest/images/default.jpg') }}" alt="Prestasi {{ $item->title }}">
                <div class="textArtikel">
                    <h3>{{ $item->title }}</h3>
                    <p>
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 200, '...') }}
                    </p>
                    <p class="text-muted"><small>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</small></p>
                </div>
            </div>
        </a>
    @empty
        <p class="text-center text-muted">Belum ada data prestasi tersedia.</p>
    @endforelse
</div>
@endsection
