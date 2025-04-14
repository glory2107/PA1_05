
@extends('layouts.guest.app')

@section('title', 'Event')

@section('content')
<div class="container titleArtikel" style="margin-top: 80px;">
    <h1>Berita</h1>
</div>

<div class="container artikel">
    @forelse ($events as $event)
        <a href="{{ route('guest.event.detail', $event->id) }}" class="text-decoration-none">
            <div class="perArtikel mb-4">
                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('guest/images/default.jpg') }}" alt="Event {{ $event->name }}">
                <div class="textArtikel">
                    <h3>{{ $event->name }}</h3>
                    <p>
                        {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 200, '...') }}
                    </p>
                    <p class="text-muted"><small>{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</small></p>
                </div>
            </div>
        </a>
    @empty
        <p class="text-center text-muted">Belum ada event tersedia.</p>
    @endforelse
</div>
@endsection
