@extends('layouts.guest.app')

@section('title', 'Home')

@section('content')

{{-- Banner Carousel --}}  
<div id="banner" class="carousel slide carousel-fade" data-ride="carousel" style="position: relative; height: 585px;">

    {{-- Indicators --}}
    <ol class="carousel-indicators">
        @php $slideIndex = 0; @endphp
        @foreach($sliders as $slider)
            @php $images = json_decode($slider->image, true) ?? []; @endphp
            @foreach($images as $img)
                <li data-target="#banner" data-slide-to="{{ $slideIndex }}" class="{{ $slideIndex == 0 ? 'active' : '' }}"></li>
                @php $slideIndex++; @endphp
            @endforeach
        @endforeach
    </ol>

    {{-- Slides --}}
    <div class="carousel-inner" style="height: 585px; position: relative;">
        @php $slideIndex = 0; @endphp
        @foreach($sliders as $slider)
            @php $images = json_decode($slider->image, true) ?? []; @endphp
            @foreach($images as $img)
                <div class="carousel-item {{ $slideIndex == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/guest/images/' . $img) }}" class="d-block w-100" style="height: 585px; object-fit: cover;" alt="Slider {{ $slideIndex + 1 }}">
                </div>
                @php $slideIndex++; @endphp
            @endforeach
        @endforeach
    </div>

    {{-- Controls --}}
    <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev" style="
        position: absolute !important;
        top: 50% !important;
        left: 70px !important;
        transform: translateY(-50%) !important;
        width: 40px !important;
        height: 40px !important;
        background-color: rgba(50, 50, 50, 0.86);
        border-radius: 50%;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 10;
        cursor: pointer;
        padding: 0;
        border: none;
        outline: none;">
        <span class="custom-carousel-control-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="none" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="11 1 5 8 11 15"/>
            </svg>
        </span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#banner" role="button" data-slide="next" style="
        position: absolute !important;
        top: 50% !important;
        right: 70px !important;
        transform: translateY(-50%) !important;
        width: 40px !important;
        height: 40px !important;
        background-color: rgba(50, 50, 50, 0.85);
        border-radius: 50%;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 10;
        cursor: pointer;
        padding: 0;
        border: none;
        outline: none;">
        <span class="custom-carousel-control-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="none" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="5 1 11 8 5 15"/>
            </svg>
        </span>
        <span class="sr-only">Next</span>
    </a>
</div>



{{-- Sambutan --}}
<div class="sambutan">
    <h1>WELCOME TO SMP NEGERI 1 SIANTAR NARUMONDA</h1>
    <p>
        SMP NEGERI 1 SIANTAR NARUMONDA merupakan salah satu sekolah jenjang SMP berstatus Negeri yang berada di wilayah<br>
        Kec. Siantar Narumonda, Kab. Toba, Sumatera Utara.
    </p>
</div>

{{-- Visi Misi Dinamis tanpa card tapi dengan background --}}
<div class="kepsek pt-4">
    <div class="container-fluid px-5">
        @foreach ($profils as $profil)
            {{-- Wrapper full width --}}
            <div class="bg-fullwidth mb-4">
                <div class="card-custom-dark">
                    <div class="row no-gutters align-items-center">
                        @if ($profil->image)
                            <div class="col-md-4 d-flex justify-content-center">
                                <img src="{{ asset('storage/' . $profil->image) }}" alt="{{ $profil->title }}" class="img-no-card">
                            </div>
                        @endif

                        <div class="col-md-8 {{ $profil->image ? '' : 'col-md-12' }}">
                            <div class="card-body">
                                <h5 class="card-title text-custom-light text-center enlarged-title">{{ $profil->title }}</h5>
                                <p class="card-text text-custom-light">{!! $profil->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Wrapper untuk background full width */
    .bg-fullwidth {
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
        background-color: rgb(8,36,68);
    }

    /* Container dalam bg-fullwidth untuk batasi isi */
    .card-custom-dark {
        background: transparent !important; /* supaya background di bg-fullwidth */
        max-width: 1300px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        color: #ffffff !important;
        border-radius: 0; /* hilangkan border radius */
    }

    /* Teks putih */
    .text-custom-light {
        color: #ffffff !important;
    }

    /* Judul diperbesar dan diberi jarak bawah */
    .enlarged-title {
        font-size: 2rem !important;
        font-weight: 700 !important;
        margin-bottom: 20px !important;
    }

    /* Jarak atas paragraf */
    .card-body > p {
        margin-top: 10px !important;
    }

    /* Text center */
    .text-center {
        text-align: center !important;
    }

    .img-no-card {
        width: 400px;
        height: auto;
        object-fit: cover;
        margin: 0 auto;
        display: block;
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
    }

    /* Reset gutter dan align vertikal */
    .no-gutters {
        margin-left: 0 !important;
        margin-right: 0 !important;
        display: flex !important;
        align-items: center !important;
    }

    /* Padding nyaman di card-body */
    .card-body {
        padding: 2rem 2rem !important;
    }
</style>

{{-- Fasilitas Dinamis --}}     
<style>
    /* Background putih keseluruhan */
    body, .jurusan {
        background-color: #ffffff !important;
    }

    /* Mengatur jarak antara navbar dan judul */
    .jurusan {
        padding-top: 10px !important;
        margin-top: 0 !important;
    }

    .jurusan h2 {
        margin-top: 0 !important;
        margin-bottom: 20px;
    }

    .boxJurusan {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 30px !important;
    }

    .perBox {
        background-color: #ffffff !important;
        padding: 25px 25px 50px 25px;
        box-sizing: border-box;
        cursor: pointer;
        text-align: center;
        border-radius: 8px !important;
        transition: box-shadow 0.3s ease;
        min-height: 270px;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* bayangan dasar */
    }

    .perBox:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* bayangan saat hover */
        /* Tidak ada efek naik */
    }

    .perBox img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 8px 8px 0 0 !important;
        margin-bottom: 15px;
    }

    .perBox h3 {
        background-color: #ffffff !important;
        color: rgb(8, 36, 68) !important;
        padding: 10px 15px 30px 15px !important;
        border-radius: 0 !important;
        display: inline-block !important;
        transition: color 1.5s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        font-size: 1.3rem;
        font-weight: 600;
        user-select: none;
    }

    .perBox h3:hover {
        color: #FFD700 !important;
    }

    @media (max-width: 768px) {
        .boxJurusan {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 480px) {
        .boxJurusan {
            grid-template-columns: 1fr !important;
        }
    }

    .btn-custom {
        border: 2px solid #002856;
        background-color: #fff;
        color: #002856;
        font-weight: 700;
        padding: 6px 20px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        display: inline-block;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-custom:hover {
        background-color: #002856;
        color: #fff;
        text-decoration: none;
    }
</style>

<div class="jurusan">
    <div class="container">
        <h2>Fasilitas</h2>
        <div class="boxJurusan">
            @forelse ($fasilitas as $item)
                <a href="{{ route('guest.fasilitassekolah.detail', $item->id) }}" class="text-decoration-none" style="color: inherit;">
                    <div class="perBox">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        @else
                            <img src="{{ asset('guest/images/default.jpg') }}" alt="Fasilitas Default">
                        @endif
                        <h3>{{ $item->title }}</h3>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-600">Belum ada data fasilitas sekolah yang tersedia.</p>
            @endforelse
        </div>

        <!-- Tombol Tampilkan Semua Fasilitas -->
        <div class="text-center mt-4">
            <a href="{{ route('guest.fasilitassekolah') }}" class="btn-custom">
                Tampilkan Semua Fasilitas
            </a>
        </div>
    </div>
</div>






{{-- Alumni Dinamis --}} 
<div class="alumni-section">
    <div class="container py-5">
        <h2 class="text-white mb-2 text-center">Alumni</h2>
        <section class="pt-4">
            <div class="row justify-content-center">
                @php
                    $displayAlumni = $alumni->take(6);
                @endphp

                @forelse ($displayAlumni as $person)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('guest.alumni.detail', $person->id) }}" class="text-decoration-none text-dark">
                            <div
                                class="card h-100"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease; background-color: #fff; border: none;"
                                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)';"
                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                            >
                                <img src="{{ $person->image ? asset('storage/' . $person->image) : asset('guest/images/default.jpg') }}"
                                    class="card-img-top rounded-circle mx-auto d-block mt-3"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                                    alt="Alumni {{ $person->name }}">
                                <div class="card-body text-center">
                                    <h5
                                        class="card-title"
                                        onmouseover="this.style.color='#007bff'"
                                        onmouseout="this.style.color=''"
                                    >
                                        {{ $person->name }}
                                    </h5>
                                    <p class="card-text text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($person->description), 100, '...') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-light">Belum ada data alumni tersedia.</p>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('guest.alumni') }}" class="btn btn-outline-warning px-4 py-2" style="border-radius: 25px; font-weight: 600;">
                    Tampilkan Semua Alumni
                </a>
            </div>
        </section>
    </div>
</div>

<style>
    .alumni-section {
        background-color: rgb(8, 36, 68);
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
        padding-top: 20px;
        padding-bottom: 40px;
    }

    .alumni-section h2 {
        font-weight: 700;
        position: relative;
        top: -8px;
        letter-spacing: 2px;
    }

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #003366;
        text-decoration: none;
    }
</style>

{{-- Prestasi Dinamis --}}     
<div class="containerArtikelHome container mt-2 mb-5">
    <h2 class="text-center mb-4">Prestasi</h2>
    <div class="row">
        @forelse ($prestasi as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border" style="border-radius: 0;">
                    <a href="{{ route('guest.prestasi.detail', $item->id) }}" class="text-decoration-none text-dark">
                        <img
                            src="{{ $item->image ? asset('storage/' . $item->image) : asset('guest/images/default.jpg') }}"
                            alt="Prestasi {{ $item->title }}"
                            class="card-img-top"
                            style="height: 180px; object-fit: cover; border-radius: 0;"
                        >
                        <div class="card-body">
                            <h5 class="card-title text-uppercase fw-bold mb-3">{{ $item->title }}</h5>

                            <hr class="prestasi-separator" />

                            <a href="{{ route('guest.prestasi.detail', $item->id) }}" class="read-more-link">
                                READ MORE &raquo;
                            </a>

                        </div>
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada data prestasi tersedia.</p>
        @endforelse
    </div>

    <!-- Tombol Tampilkan Semua Prestasi -->
    <div class="text-center mt-4">
        <a href="{{ route('guest.prestasi') }}" class="btn-custom">
            Tampilkan Semua Prestasi
        </a>
    </div>
</div>

<style>
    .containerArtikelHome h2 {
        margin-top: 0 !important;       
        margin-bottom: 3rem !important; 
    }

    .card {
        border-radius: 0 !important;
    }
    .card-img-top {
        border-radius: 0 !important;
    }

    .card-title {
        color: rgb(8, 36, 68);
        text-decoration: none;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    .card-title:hover {
        color: #FCC404;
        transition: color 1.2s ease;
    }

    .read-more-link {
        color: #555555; /* abu gelap */
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        display: inline-block;
        margin-top: 0.5rem;
        transition: color 1.2s ease;
    }
    .read-more-link:hover {
        color: #FCC404;
        text-decoration: none;
        transition: color 1.2s ease;
    }

    .prestasi-separator {
        border: none;
        border-top: 1px solid #ddd;
        margin: 0 0 0.75rem 0; /* margin bawah agar ada jarak ke read more */
    }

    /* Tombol custom konsisten dengan fasilitas */
    .btn-custom {
        border: 2px solid #002856;
        background-color: #fff;
        color: #002856;
        font-weight: 700;
        padding: 6px 20px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        display: inline-block;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-custom:hover {
        background-color: #002856;
        color: #fff;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-img-top {
            height: 150px !important;
        }
    }
</style>


{{-- Ekstrakurikuler Dinamis --}}        
<div class="ekstrakurikuler-section">
    <div class="container py-5">
        <h2 class="text-white mb-4 text-center">Ekstrakurikuler</h2>
        <section class="pt-4">
            <div class="row justify-content-center gx-4 gy-4">
                @php
                    $displayEkstrakurikuler = $ekstrakurikuler->take(8);
                @endphp

                @forelse ($displayEkstrakurikuler as $item)
                    <div class="col-6 col-sm-4 col-md-3">
                        <a href="{{ route('guest.ekstrakurikuler.detail', $item->id) }}" class="text-decoration-none">
                            <div
                                class="ekstrakurikuler-box d-flex flex-column align-items-center justify-content-center p-4"
                            >
                                <div class="icon-wrapper d-flex align-items-center justify-content-center">
                                    <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('guest/images/default.jpg') }}" alt="{{ $item->name }}" />
                                </div>
                                <h6 class="text-center">
                                    {{ $item->name }}
                                </h6>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-light">Belum ada data ekstrakurikuler tersedia.</p>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('guest.ekstrakurikuler') }}" class="btn btn-outline-warning px-4 py-2" style="border-radius: 25px; font-weight: 600;">
                    Tampilkan Semua Ekstrakurikuler
                </a>
            </div>
        </section>
    </div>
</div>

<style>
    .ekstrakurikuler-section {
        background-color: #002856;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .ekstrakurikuler-section h2 {
        font-weight: 700;
        letter-spacing: 2px;
        color: #fff;
    }

  
    .ekstrakurikuler-box {
        background-color: #ffffff;
        border-radius: 6px;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        min-height: 220px;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        gap: 2.5rem; 
    }

    .ekstrakurikuler-box:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }

    .icon-wrapper {
        background-color: #fff;
        width: 140px;   
        height: 140px; 
        border-radius: 50%;
        overflow: hidden;
    }

    .icon-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

 
    h6 {
        color: #555555;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        cursor: pointer;
        position: relative;
        padding-bottom: 4px;
        transition: color 0.3s ease;
        margin: 0;
    }

    h6::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: rgb(8, 36, 68);
        transition: width 1s ease;
    }

    h6:hover {
        color: #ffc107;
        transition: color 1.2s ease;
    }

    h6:hover::after {
        width: 100%;
    }

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #002856;
        text-decoration: none;
    }

    @media (max-width: 576px) {
        .col-6 {
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
    }
</style>