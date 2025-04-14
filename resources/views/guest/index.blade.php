@extends('layouts.guest.app')

@section('title', 'Home')

@section('content')

    {{-- Banner --}}
    <div id="banner" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('guest/images/5e72f65c1f909-teamwork-desktop2.jpg') }}" class="d-block w-100" alt="Banner">
            </div>
        </div>
    </div>

    {{-- Sambutan --}}
    <div class="sambutan">
        <h1>WELCOME TO SMK N 2 PURBALINGGA</h1>
        <p>
            SMKN 2 Purbalingga merupakan sekolah terbagus dan terluas yang ada di Purbalingga.<br>
            Ada 5 jurusan yang siap mempersiapkan anda menjadi orang sukses.
        </p>
    </div>

    {{-- Kepala Sekolah --}}
    <div class="kepsek">
        <div class="container">
            <img src="{{ asset('guest/images/darimun.jpeg') }}" alt="Kepala SMK N 2 Purbalingga">
            <div class="visiMisi">
                <div class="visi">
                    <h5>Our Vision</h5>
                    <h3>Nurturing Leaders for God, Country and Community</h3>
                </div>
                <div class="misi">
                    <h5>Our Mission</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet cum id reiciendis laudantium esse fuga quo...
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Jurusan --}}
    <div class="jurusan">
        <div class="container">
            <h2>Jurusan Smakda</h2>
            <div class="boxJurusan">
                @foreach (['1.jpg' => 'Rekayasa Perangkat Lunak', '2.jpeg' => 'Agribisnis Ternak Unggas', '3.jpeg' => 'Agribisnis Pengolahan Hasil Pangan', '4.jpeg' => 'Agribisnis Perikanan Ikan', '5.jpeg' => 'Teknik Kendaraan Ringan'] as $img => $nama)
                    <div class="perBox">
                        <img src="{{ asset('guest/images/' . $img) }}" alt="{{ $nama }}">
                        <h3>{{ $nama }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Artikel Prestasi --}}
    <div class="containerArtikelHome container">
        <h2>Prestasi</h2>
        <div class="artikelHome">
            @for($i = 1; $i <= 3; $i++)
                <a class="perArtikelHome">
                    <img src="{{ asset('guest/images/1.jpg') }}" alt="Foto Artikel">
                    <h3>Tutorial Login Laravel 8</h3>
                    <small>Di tulis oleh : <span>Rifki Romadhan</span></small>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti quo...
                    </p>
                </a>
            @endfor
        </div>
    </div>

    {{-- Alumni --}}
    <div class="containerArtikelHome container">
        <h2>Alumni</h2>
        <section class="pt-7" style="margin-top: 60px;">
            <div class="container">
                <div class="row">
                    @for($i = 1; $i <= 3; $i++)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('guest/images/basket.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card {{ $i }}</h5>
                                    <p class="card-text">Some quick example text.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </div>
@endsection
