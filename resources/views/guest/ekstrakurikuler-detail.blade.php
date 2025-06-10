@extends('layouts.guest.app') 

@section('title', 'Detail Ekstrakurikuler - ' . $ekstrakurikuler->name)

@section('content')

<div class="container mt-3 pt-3">
    <div class="row">
        <!-- Sidebar kiri: daftar ekstrakurikuler lainnya -->
        <div class="col-lg-4 col-md-5">
            <div class="sidebar">
                <div class="sidebar-section">
                    <h4 class="sidebar-title">Ekstrakurikuler Lainnya</h4>
                    <div class="recent-events">
                        @php
                            // Ambil 5 ekstrakurikuler terbaru selain yang sedang ditampilkan
                            $otherEkstrakurikuler = \App\Models\Ekstrakurikuler::where('id', '!=', $ekstrakurikuler->id)->latest('created_at')->take(5)->get();
                        @endphp

                        @foreach($otherEkstrakurikuler as $other)
                            <div class="news-item">
                                <div class="news-image">
                                    <img src="{{ $other->image ? asset('storage/' . $other->image) : asset('guest/images/default.jpg') }}" alt="{{ $other->name }}">
                                </div>
                                <div class="news-content">
                                    <a href="{{ route('guest.ekstrakurikuler.detail', $other->id) }}" class="news-link">
                                        <h6 class="news-title">{{ \Illuminate\Support\Str::limit($other->name, 60, '...') }}</h6>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten utama kanan: detail ekstrakurikuler -->
        <div class="col-lg-8 col-md-7">
            <div class="main-content">
                @if ($ekstrakurikuler->image)
                    <div class="mb-3 text-start image-container">
                        <img src="{{ asset('storage/' . $ekstrakurikuler->image) }}" alt="{{ $ekstrakurikuler->name }}" 
                            style="width: 100%; height: auto; object-fit: cover; max-height: 420px;">
                    </div>

                    <div class="full-width-hr-wrapper">
                        <hr class="image-hr" />
                    </div>
                @endif

                <h4 class="font-weight-bold mb-4 text-start" style="color: #003366;">
                    {{ $ekstrakurikuler->name }}
                </h4>

                <div class="text-justify" style="color: #4a4a4a; margin-bottom: 3rem;">
                    {!! $ekstrakurikuler->description !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>

.sidebar {
    background: white;
    padding: 0 15px;
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

.recent-events {
    margin-top: 10px;
}

.news-item {
    display: flex;
    align-items: center;
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

.image-hr {
    border: none;
    border-bottom: 2.5px solid #e8e4e4;
    margin: 2.5rem 0 2rem 0;
    width: 100%;
}

.event-description {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
}


@media (max-width: 768px) {
    .main-content {
        padding-left: 0;
        margin-top: 30px;
    }
    .news-item {
        flex-direction: column;
        align-items: center;
    }
    .news-image {
        width: 120px;
        height: 120px;
        margin-bottom: 10px;
    }
    .news-content {
        text-align: center;
    }
}
</style>
