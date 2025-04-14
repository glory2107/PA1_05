@extends('layouts.guest.app')

@section('title', 'Pengumuman')

@section('content')
<section class="pt-7" style="margin-top: 60px;">
    <div class="container">
        <div class="mb-7 text-center">
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Pengumuman Sekolah</h3>
        </div>

        <div class="row g-4">
            @forelse ($pengumuman as $item)
    <div class="col-md-6">
        <a href="{{ route('guest.pengumuman.detail', $item->id) }}" class="text-decoration-none text-dark">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                    <p class="text-muted"><small>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</small></p>
                    <p class="card-text text-justify">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 120, '...') }}
                    </p>
                    @if ($item->file)
                        <span class="badge bg-info text-white">Ada Lampiran</span>
                    @endif
                </div>
            </div>
        </a>
    </div>
@empty
    <p class="text-center text-muted">Belum ada pengumuman aktif.</p>
@endforelse

        </div>
    </div>
</section>
@endsection
