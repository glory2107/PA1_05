@extends('layouts.guest.app')

@section('title', 'Detail Prestasi - ' . $prestasi->title)

@section('content')

<div class="page-wrapper-event">
    <div class="container mt-3 pt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-5">
                <div class="sidebar">
                    
                    <!-- Prestasi Terbaru Section -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">Prestasi Terbaru</h4>
                        <div class="recent-news">
                            @php
                                // Fetch the most recent achievements based on 'tanggal' (achievement date)
                                $recentPrestasi = \App\Models\Prestasi::latest('tanggal')->take(5)->get();
                            @endphp
                            
                            @foreach($recentPrestasi as $recent)
                                <div class="news-item">
                                    <div class="news-image">
                                        <img src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('guest/images/default.jpg') }}" alt="{{ $recent->title }}">
                                    </div>
                                    <div class="news-content">
                                        <div class="news-date">
                                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($recent->tanggal)->translatedFormat('d M Y') }}
                                        </div>
                                        <a href="{{ route('guest.prestasi.detail', $recent->id) }}" class="news-link">
                                            <h6 class="news-title">{{ \Illuminate\Support\Str::limit($recent->title, 60, '...') }}</h6>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8 col-md-7">
                <div class="main-content">
                    {{-- Gambar utama --}}
                    @if ($prestasi->image)
                    <div class="mb-3 text-start">
                        <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" 
                            class="img-fluid shadow" 
                            style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                    @endif

                    {{-- Judul Prestasi --}}
                    <h3 class="prestasi-title" style="color: #003366; font-weight: 700; margin-bottom: 20px;">
                        {{ $prestasi->title }}
                    </h3>

                    <!-- Garis horizontal abu-abu di bawah judul -->
                    <hr class="image-hr" />

                    {{-- Tanggal Prestasi dan Admin Icon --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="text-muted" style="font-size: 0.9rem;">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="admin-info" style="font-size: 0.9rem; color: #666;">
                            <i class="fas fa-user-shield"></i> Admin
                        </p>
                    </div>

                    {{-- Card untuk Deskripsi --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="text-justify" style="color: #4a4a4a;">
                                {!! $prestasi->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
.page-wrapper-event {
    background-color: white;
    min-height: 100vh;
}

.container.mt-3.pt-3 {
    padding-top: 120px; /* Jarak dari navbar diperbesar */
    margin-top: 20px;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.sidebar {
    background: white;
}

.sidebar-section {
    padding: 25px 0;
    border-bottom: 1px solid #eee;
}

.sidebar-section:last-child {
    border-bottom: none;
}

.sidebar-title {
    color: #003366;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
    position: relative;
    padding-bottom: 8px;
}

.sidebar-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 3px;
    background: linear-gradient(90deg, #ff6b35, #f7931e);
}

.search-input-group {
    display: flex;
    border-radius: 0;
    overflow: hidden;
    box-shadow: none;
    width: 100%;
}

.search-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-right: none;
    font-size: 14px;
    outline: none;
    border-radius: 0;
}

.search-btn {
    padding: 12px 20px;
    background: #003366;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: 600;
    border-radius: 0;
    transition: background-color 0.3s ease;
}

.search-btn:hover {
    background: #002244;
}

.recent-news {
    margin-top: 10px;
}

.news-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgb(240, 240, 240);
}

.news-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.news-image {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 15px;
    flex-shrink: 0;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-content {
    flex: 1;
}

.news-date {
    color: #666;
    font-size: 12px;
    margin-bottom: 5px;
}

.news-date i {
    color: rgba(8, 36, 68, 0.5);
    margin-right: 5px;
}

.news-link, 
.news-link:hover, 
.news-link:focus, 
.news-link:active {
    text-decoration: none !important;
}

.news-title {
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #333;
    line-height: 1.4;
    margin: 0;
    font-weight: 600;
    transition: color 0.3s ease;
}

.news-link:hover .news-title {
    color: #007bff;
}

.main-content {
    padding-left: 30px;
}

.prestasi-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 22px;
    color: #003366;
    margin-bottom: 15px;
    line-height: 1.3;
    transition: color 0.3s ease;
}

.prestasi-description {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.admin-info {
    font-size: 0.9rem;
    color: #666;  
}

.admin-info i {
    margin-right: 5px;
}

.image-hr {
    border: none;
    border-bottom: 2.5px solid #ccc; 
    margin: 2.5rem 0 2rem 0;
    width: 100%;
}


@media (max-width: 768px) {
    .main-content {
        padding-left: 0;
        margin-top: 30px;
    }

    .prestasi-title {
        font-size: 18px;
    }

    .sidebar-section {
        padding: 20px 0;
    }
}

@media (max-width: 576px) {
    .event-content {
        padding: 20px;
    }
}
</style>
