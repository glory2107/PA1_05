@extends('layouts.guest.app')

@section('title', 'Tenaga Kerja')

@section('content')
<section class="pt-7" style="margin-top: 60px;">
    <div class="container">
        <div class="mb-7 text-center">
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Tenaga Kerja</h3>
        </div>

        <div class="row justify-content-center g-4">
            @forelse ($tenagaKerja as $person)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $person->image ? asset('storage/' . $person->image) : asset('guest/images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="{{ $person->name }}" 
                             style="object-fit: cover; height: 250px;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $person->name }}</h5>
                            <p class="card-text text-muted">{{ $person->jabatan }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada data tenaga kerja tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
