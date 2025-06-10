@extends('layouts.guest.app')   

@section('title', 'Detail Pengumuman - ' . $pengumuman->title)

@section('content')
<div class="container mt-3 pt-5">
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
            <div class="main-content" style="padding-left: 40px;">
                
                {{-- Gambar opsional --}}
                @if ($pengumuman->image)
                    <div class="content-section">
                        <img src="{{ asset('storage/' . $pengumuman->image) }}" alt="{{ $pengumuman->title }}" 
                             class="img-fluid shadow rounded" 
                             style="width: 100%; height: auto; object-fit: cover;">
                    </div>
                @endif

                {{-- Judul pengumuman --}}
                <div class="content-section">
                    <h4 class="pengumuman-title">
                        {{ $pengumuman->title }}
                    </h4>
                </div>

                <!-- Garis horizontal abu-abu di bawah judul pengumuman -->
                <div class="content-section">
                    <hr class="image-hr" />
                </div>

                {{-- Tanggal pengumuman dan Icon Admin sejajar --}}
                <div class="content-section">
                    <div class="d-flex justify-content-between align-items-center date-admin-info">
                        <p class="text-muted" style="font-size: 14px;">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="admin-info">
                            <i class="fas fa-user-shield"></i> Admin
                        </p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="content-section">
                    <div class="description">
                        {!! $pengumuman->description !!}
                    </div>
                </div>

                {{-- Lampiran --}}
                @if ($pengumuman->file)
                    <div class="content-section">
                        <hr class="my-4">
                        <p><strong>Lampiran:</strong></p>
                        <a href="{{ asset('storage/' . $pengumuman->file) }}" target="_blank" 
                           class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-2">
                            <i class="fas fa-file-alt"></i> Lihat Dokumen
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<style>

.main-content {
    max-width: 900px;
    margin: 0 auto;
    padding-left: 40px;
}


@media (min-width: 768px) {
    .main-content {
        padding-left: 40px;
    }
}


.content-section {
    margin-bottom: 1.5rem;
    padding-left: 0;
    padding-right: 0;
}

.content-section:last-child {
    margin-bottom: 0;
}


.pengumuman-title {
    font-weight: bold;
    color: #003366;
    margin-bottom: 0;
    text-align: left;
}


.image-hr {
    border: none;
    border-bottom: 2.5px solid #ccc;
    margin: 0;
    width: 100%;
}


.date-admin-info {
    margin-bottom: 0;
}

.admin-info {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0;
}

.admin-info i {
    margin-right: 5px;
}


.description {
    text-align: justify;
    color: #4a4a4a;
    font-size: 16px;
    line-height: 1.7;
}


.btn-outline-primary {
    color: #003366;
    border-color: #003366;
    font-weight: 600;
}

.btn-outline-primary:hover {
    background-color: #003366;
    color: white;
    border-color: #003366;
}

.gap-2 {
    gap: 8px;
}


.sidebar {
    background: white;
}

.sidebar-section {
    padding: 25px 20px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
}

.sidebar-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.sidebar-title {
    color: #003366;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
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
    padding: 12px 15px;
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
    margin-bottom: 25px;
    padding-bottom: 20px;
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


@media (max-width: 768px) {
    .content-section {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .main-content {
        padding-left: 0 !important;
    }
    
    .sidebar-section {
        padding: 20px 15px;
        margin-bottom: 20px;
    }
    
    .news-item {
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
}
</style>