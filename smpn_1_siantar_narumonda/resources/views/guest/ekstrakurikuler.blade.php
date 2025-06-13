@extends('layouts.guest.app')  

@section('title', 'Ekstrakurikuler SMP 1 Siantar Narumonda')

@section('content')

<div class="page-wrapper-ekstrakurikuler">
    <div class="container-fluid titleArtikel py-4 text-center" style="margin-top: 0px; max-width: 1140px;">
        <div class="line-container">
            <hr class="solid-line">
            <h1 style="color: #003366; font-size: 2rem; font-weight: bold; display: inline-block;">EKSTRAKURIKULER</h1>
            <hr class="solid-line">
        </div>
    </div>

    <div class="container-fluid" style="max-width: 1140px;">
        <div class="boxJurusan">
            @forelse ($ekstrakurikuler as $item)
                <a href="{{ route('guest.ekstrakurikuler.detail', $item->id) }}" class="text-decoration-none text-dark facility-item">
                    <div class="perBox">
                        <div class="image-wrapper">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                            @else
                                <img src="{{ asset('guest/images/default.jpg') }}" alt="Ekstrakurikuler Default">
                            @endif
                            <div class="overlay"></div>
                        </div>
                        <h3>{{ $item->name }}</h3>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-600">Belum ada data ekstrakurikuler yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection

<style>
.page-wrapper-ekstrakurikuler {
    background-color: #f2f2f2;
    padding-top: 20px;
    padding-bottom: 20px;
    min-height: auto;
    flex-grow: 1;
}

body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.solid-line {
    border-top: 2px solid #003366;
    width: 100px;
    margin: 0 10px;
    display: inline-block;
    vertical-align: middle;
}

.line-container {
    display: flex;
    align-items: center;
    justify-content: center;
}

.boxJurusan {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding-bottom: 50px;
}

.perBox {
    width: 350px;
    min-height: 320px;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: none;
    transition: box-shadow 0.3s ease;
    text-align: left;
    margin-bottom: 10px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    position: relative;
}

.image-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
    display: block;
}

.image-wrapper:hover img {
    transform: scale(1.1);
}

.image-wrapper .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(128, 128, 128, 0.58);
    opacity: 0;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 2;
}

.image-wrapper:hover .overlay {
    opacity: 1;
}

.perBox h3 {
    padding: 20px 15px 15px 20px;
    font-size: 18px;
    font-weight: 600;
    color: #333;
    text-align: left;
    margin: 0;
    background-color: #f8f9fa;
    transition: color 0.3s ease; 
}

.perBox h3:hover {
    color: #007bff; 
}


@media (max-width: 992px) {
    .perBox {
        width: 45%;
    }
}

@media (max-width: 576px) {
    .perBox {
        width: 90%;
    }
}
</style>
