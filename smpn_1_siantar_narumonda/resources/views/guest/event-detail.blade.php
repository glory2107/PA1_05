@extends('layouts.guest.app') 

@section('title', 'Detail Event - ' . $event->name)

@section('content')

<div class="page-wrapper-event">
    <div class="container mt-3 pt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-5">
                <div class="sidebar">
                    <!-- Search Section -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">SEARCH</h4>
                        <form method="GET" action="{{ route('guest.event') }}" class="search-form">
                            <div class="search-input-group">
                                <input type="text" name="search" value="{{ request('search') ?? '' }}" class="search-input" placeholder="Cari berita...">
                                <button type="submit" class="search-btn">Search</button>
                            </div>
                        </form>
                    </div>

                    <!-- Berita Terbaru Section -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">Berita Terbaru</h4>
                        <div class="recent-news">
                            @php
                                // Ambil 5 berita terbaru berdasarkan tanggal, bukan berdasarkan created_at
                                $recentEvents = \App\Models\Event::latest('tanggal')->take(5)->get();
                            @endphp
                            
                            @foreach($recentEvents as $recentEvent)
                                <div class="news-item">
                                    <div class="news-image">
                                        <img src="{{ $recentEvent->image ? asset('storage/' . $recentEvent->image) : asset('guest/images/default.jpg') }}" alt="{{ $recentEvent->name }}">
                                    </div>
                                    <div class="news-content">
                                        <div class="news-date">
                                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($recentEvent->tanggal)->translatedFormat('d M Y') }}
                                        </div>
                                        <a href="{{ route('guest.event.detail', $recentEvent->id) }}" class="news-link">
                                            <h6 class="news-title">{{ \Illuminate\Support\Str::limit($recentEvent->name, 60, '...') }}</h6>
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
                    @if ($event->image)
                    <div class="mb-3 text-start">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" 
                            class="img-fluid shadow" 
                            style="width: 100%; height: auto; object-fit: cover;">
                    </div>
                    @endif

                    {{-- Judul event --}}
                    <h3 class="event-title" style="color: #003366; font-weight: 700; margin-bottom: 20px;">
                        {{ $event->name }}
                    </h3>

                    <!-- Garis horizontal abu-abu di bawah judul -->
                    <hr class="image-hr" />

                    {{-- Tanggal event dan Admin Icon --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="text-muted" style="font-size: 0.9rem;">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="admin-info" style="font-size: 0.9rem; color: #666;">
                            <i class="fas fa-user-shield"></i> Admin
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="event-description" style="color: #4a4a4a;">
                        {!! $event->description !!}
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
    padding-top: 120px; 
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

.event-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 22px;
    color: #003366;
    margin-bottom: 15px;
    line-height: 1.3;
    transition: color 0.3s ease;
}

.event-description {
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

    .event-title {
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
