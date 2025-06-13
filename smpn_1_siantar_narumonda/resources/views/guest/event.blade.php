@extends('layouts.guest.app') 

@section('content')

<div class="page-wrapper-event">

    <div class="title-container">
        <span class="line"></span>
        <h1>BERITA</h1>
        <span class="line"></span>
    </div>

    <div class="container-fluid">
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
                                // Mengambil 5 berita terbaru berdasarkan tanggal
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
                    @forelse ($events as $event)
                        <div class="event-card">
                            <div class="event-image">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('guest/images/default.jpg') }}" alt="Event {{ $event->name }}">
                                <div class="event-date">
                                    <span class="date-day">{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</span>
                                    <span class="date-month">{{ \Carbon\Carbon::parse($event->tanggal)->format('M, Y') }}</span>
                                </div>
                            </div>
                            <div class="event-content">
                                <a href="{{ route('guest.event.detail', $event->id) }}" class="event-title-link">
                                    <h3 class="event-title">{{ $event->name }}</h3>
                                </a>
                                <p class="event-description">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 200, '...') }}
                                </p>
                                <div class="event-meta">
                                    <a href="{{ route('guest.event.detail', $event->id) }}" class="read-more-link">
                                        <span class="read-more">READ MORE >></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-events">
                            <p class="text-center text-muted">Belum ada event tersedia.</p>
                        </div>
                    @endforelse

                    <!-- Pagination links -->
                    <div class="pagination-wrapper">
                        @if ($events->hasPages())
                            <ul class="pagination">
                                @php
                                    $maxLinks = 5;
                                    $currentPage = $events->currentPage();
                                    $lastPage = $events->lastPage();

                                    $segment = intval(($currentPage - 1) / $maxLinks);
                                    $start = $segment * $maxLinks + 1;
                                    $end = min($start + $maxLinks - 1, $lastPage);
                                @endphp

                                {{-- Previous Page Link --}}
                                @if ($currentPage > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $events->url($currentPage - 1) }}" aria-label="Previous">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Page Number Links --}}
                                @for ($i = $start; $i <= $end; $i++)
                                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $events->url($i) }}{{ request('search') ? '&search=' . request('search') : '' }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Next Page Link --}}
                                @if ($currentPage < $lastPage)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $events->url($currentPage + 1) }}" aria-label="Next">&raquo;</a>
                                    </li>
                                @endif
                            </ul>
                        @endif
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

.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
}

.title-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    max-width: 300px;
    margin: 50px auto 60px auto;
}

.title-container .line {
    flex-grow: 1;
    border-bottom: 2px solid #003366;
    margin-top: 10px;
}

.title-container h1 {
    color: #003366;
    font-weight: 800;
    font-size: 2rem;
    margin: 0;
    white-space: nowrap;
    line-height: 1;
}

/* Sidebar Styles */
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

.event-card {
    background: white;
    border: 1px solid #eee;
    margin-bottom: 30px;
    overflow: hidden;
}

.event-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.event-image img:hover {
    transform: scale(1.05);
}

.event-date {
    position: absolute;
    top: 175px;
    left: 10px;
    background: linear-gradient(135deg, rgba(18,45,90,0.7), rgba(11,34,74,0.7));
    color: #fcb405;
    padding: 10px 15px;
    text-align: center;
    border-radius: 0px;
    font-weight: bold;
}

.date-day {
    display: block;
    font-size: 24px;
    font-weight: bold;
    line-height: 1;
}

.date-month {
    display: block;
    font-size: 12px;
    opacity: 0.9;
}

.event-content {
    padding: 25px;
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

.event-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.read-more-link, 
.read-more-link:hover, 
.read-more-link:focus, 
.read-more-link:active {
    text-decoration: none !important;
}

.read-more {
    color: #666;
    font-size: 13px;
    font-weight: 600;
    transition: color 0.3s ease;
}

.read-more-link:hover .read-more {
    color: #007bff;
}

.event-author {
    color: #999;
    font-size: 13px;
}

.event-author i {
    margin-right: 5px;
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

.no-events {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border: 1px solid #eee;
}


@media (max-width: 768px) {
    .main-content {
        padding-left: 0;
        margin-top: 30px;
    }
    
    .event-image {
        height: 200px;
    }
    
    .event-title {
        font-size: 18px;
    }
    
    .sidebar-section {
        padding: 20px 0;
    }
}

@media (max-width: 576px) {
    .event-date {
        top: 15px;
        left: 15px;
        padding: 8px 12px;
    }
    
    .date-day {
        font-size: 20px;
    }
    
    .event-content {
        padding: 20px;
    }
}
</style>
