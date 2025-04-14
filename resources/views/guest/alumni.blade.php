@extends('layouts.guest.app')

@section('title', 'Alumni')

@section('content')
<div class="container titleArtikel" style="margin-top: 80px;">
    <h1>Alumni</h1>
</div>

<div class="container artikel">
    @forelse ($alumni as $person)
        <a href="{{ route('guest.alumni.detail', $person->id) }}" class="text-decoration-none">
            <div class="perArtikel mb-4">
                <img src="{{ $person->image ? asset('storage/' . $person->image) : asset('guest/images/default.jpg') }}" alt="Alumni {{ $person->name }}">
                <div class="textArtikel">
                    <h3>{{ $person->name }}</h3>
                    <p>
                        {{ \Illuminate\Support\Str::limit(strip_tags($person->description), 200, '...') }}
                    </p>
                    {{-- Jika ingin menambahkan tanggal, aktifkan baris berikut dan tambahkan field 'tanggal' di tabel --}}
                    {{-- <p class="text-muted"><small>{{ \Carbon\Carbon::parse($person->tanggal)->translatedFormat('d F Y') }}</small></p> --}}
                </div>
            </div>
        </a>
    @empty
        <p class="text-center text-muted">Belum ada data alumni tersedia.</p>
    @endforelse
</div>
@endsection
