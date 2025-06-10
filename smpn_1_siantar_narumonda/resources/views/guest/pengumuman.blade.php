@extends('layouts.guest.app')    

@section('title', 'Pengumuman')

@section('content')

<section class="pt-7" style="margin-top: 20px;">
    <div class="container-fluid titleArtikel py-4 text-center" style="margin-top: 0px; max-width: 1140px;">
        <div class="line-container">
            <hr class="solid-line">
            <h1 style="color: #003366; font-size: 2rem; font-weight: bold; display: inline-block;">PENGUMUMAN SEKOLAH</h1>
            <hr class="solid-line">
        </div>
    </div>

    <div class="container-fluid" style="max-width: 1200px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-5">
                <div class="sidebar">
                    <!-- Search Section -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">SEARCH</h4>
                        <form method="GET" action="{{ route('guest.pengumuman') }}" class="search-form">
                            <div class="search-input-group">
                                <input type="text" name="search" value="{{ request('search') ?? '' }}" class="search-input" placeholder="Cari pengumuman...">
                                <button type="submit" class="search-btn">Search</button>
                            </div>
                        </form>
                    </div>

                    <!-- Pengumuman Terbaru Section -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">Pengumuman Terbaru</h4>
                        <div class="recent-news">
                            @php
                                // Ambil pengumuman terbaru berdasarkan tanggal
                                $recentPengumuman = \App\Models\Pengumuman::latest('tanggal')->take(5)->get();
                            @endphp
                            @foreach($recentPengumuman as $recent)
                                <div class="news-item">
                                    <div class="news-content">
                                        <div class="news-date">
                                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($recent->tanggal)->translatedFormat('d M Y') }}
                                        </div>
                                        <a href="{{ route('guest.pengumuman.detail', $recent->id) }}" class="news-link">
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
                    @forelse ($pengumuman as $item)
                        <div class="event-card">
                            <div class="event-content">
                                <a href="{{ route('guest.pengumuman.detail', $item->id) }}" class="event-title-link">
                                    <h3 class="event-title">{{ $item->title }}</h3>
                                </a>
                                <p class="text-muted"><small>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</small></p>
                                <p class="event-description">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($item->description), 200, '...') !!}
                                </p>

                                @if ($item->file)
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="badge bg-info text-white" style="cursor: pointer;">
                                        Ada Lampiran
                                    </a>
                                @endif

                                <div class="event-meta">
                                    <a href="{{ route('guest.pengumuman.detail', $item->id) }}" class="read-more-link">
                                        <span class="read-more">READ MORE >></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty 
                        <div class="no-events">
                            <p class="text-center text-muted">Belum ada pengumuman aktif.</p>
                        </div>
                    @endforelse

                    <!-- Pagination links -->
                    <div class="pagination-wrapper">
                        @if ($pengumuman->hasPages())
                            <ul class="pagination">
                                @php
                                    $maxLinks = 5;
                                    $currentPage = $pengumuman->currentPage();
                                    $lastPage = $pengumuman->lastPage();

                                    $segment = intval(($currentPage - 1) / $maxLinks);
                                    $start = $segment * $maxLinks + 1;
                                    $end = min($start + $maxLinks - 1, $lastPage);
                                @endphp

                                {{-- Previous Page Link --}}
                                @if ($currentPage > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $pengumuman->url($currentPage - 1) }}" aria-label="Previous">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Page Number Links --}}
                                @for ($i = $start; $i <= $end; $i++)
                                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $pengumuman->url($i) }}{{ request('search') ? '&search=' . request('search') : '' }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Next Page Link --}}
                                @if ($currentPage < $lastPage)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $pengumuman->url($currentPage + 1) }}" aria-label="Next">&raquo;</a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<style>

.container-fluid.titleArtikel.py-4.text-center {
    margin-bottom: 40px; 
}

.solid-line {
    border-top: 2px solid #003366;
    width: 100px;
    margin: 0 10px;
    display: inline-block;
    vertical-align: middle;
}


.page-wrapper-event {
    background-color: white;
    min-height: 100vh;
}

.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
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

.event-card {
    background: white;
    border: 1px solid #eee;
    margin-bottom: 30px;
    overflow: visible; 
    padding: 25px;
    border-radius: 6px;
    position: relative; 
    z-index: 1;
}

.event-title-link, 
.event-title-link:hover, 
.event-title-link:focus, 
.event-title-link:active {
    text-decoration: none !important;
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

.event-title-link:hover .event-title {
    color: #007bff;
}

.event-description {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
}


.badge.bg-info.text-white {
    font-weight: 600;
    font-size: 13px;      
    padding: 8px 12px;    
    border-radius: 8px;    
    margin-bottom: 15px;
    display: inline-block;
    cursor: pointer;
}


.event-meta {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #eee;
    margin-top: 10px;
    position: relative;
    z-index: 10; 
}

.read-more-link {
    position: relative;
    z-index: 20;
    cursor: pointer;
    display: inline-block;
    text-decoration: none !important;
}

.read-more-link:hover .read-more {
    color: #007bff;
}

.read-more {
    color: #666;
    font-size: 13px;
    font-weight: 600;
    transition: color 0.3s ease;
}

.no-events {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border: 1px solid #eee;
}


.pagination-wrapper {
    display: flex !important;
    justify-content: center !important;
    margin-top: 40px !important;
}

.pagination {
    display: flex !important;
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

.page-item {
    margin: 0 3px !important;
}

.page-link {
    display: block !important;
    padding: 8px 14px !important;
    background: white !important;
    color: #003366 !important;
    text-decoration: none !important;
    border: 1px solid #ddd !important;
    border-radius: 3px !important;
    transition: all 0.3s ease !important;
    font-weight: 600 !important;
    cursor: pointer !important;
}

.page-item.active .page-link {
    background-color: #003366 !important;
    border-color: #003366 !important;
    color: white !important;
}

.page-item:not(.active) .page-link:hover {
    background-color: #e6f0ff !important;
    color: #003366 !important;
}


@media (max-width: 768px) {
    .main-content {
        padding-left: 0;
        margin-top: 30px;
    }
}

@media (max-width: 576px) {
    
}
</style>
