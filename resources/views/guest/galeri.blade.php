@extends('layouts.guest.app')

@section('title', 'Galeri')

@section('content')

<section class="gallery-wrapper">
    <!-- Hero Header -->
    <div class="gallery-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">
                    <span class="title-icon">📸</span>
                    GALERI KAMI
                    <span class="title-icon">🎨</span>
                </h1>
                <p class="hero-subtitle">Koleksi momen terbaik dan karya inspiratif dari perjalanan kami</p>
                <div class="title-decoration">
                    <div class="decoration-line"></div>
                    <div class="decoration-diamond"></div>
                    <div class="decoration-line"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Slider Section -->
    <div class="gallery-slider-section">
        <div class="container">
            <div class="slider-container">
                <div class="slider-wrapper">
                    <div class="slider-track">
                        @forelse ($galeri as $item)
                            <div class="slide-item">
                                <div class="gallery-card">
                                    <div class="card-image-container">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="gallery-image">
                                        @else
                                            <img src="{{ asset('guest/images/default.jpg') }}" alt="Default" class="gallery-image">
                                        @endif
                                        <div class="image-overlay">
                                            <div class="overlay-content">
                                                <i class="fas fa-search-plus"></i>
                                                <span>Lihat Detail</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">{{ $item->title }}</h3>
                                        <div class="card-divider"></div>
                                        <a href="{{ route('guest.galeri.detail', $item->id) }}" class="card-btn">
                                            <span>Selengkapnya</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="card-shine"></div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <h3>Galeri Kosong</h3>
                                <p>Belum ada galeri yang ditambahkan saat ini</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button class="slider-nav prev-nav" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-nav next-nav" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Pagination Dots -->
                <div class="slider-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>
</section>

@endsection

<style>

.gallery-wrapper {
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}


.gallery-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 8rem 0 4rem;
    position: relative;
    margin-top: -2rem;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    letter-spacing: 2px;
}

.title-icon {
    font-size: 2.5rem;
    margin: 0 1rem;
    opacity: 0.8;
    animation: bounce 2s infinite;
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    font-weight: 300;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.title-decoration {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.decoration-line {
    width: 100px;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
}

.decoration-diamond {
    width: 12px;
    height: 12px;
    background: white;
    transform: rotate(45deg);
    opacity: 0.8;
}


.gallery-slider-section {
    padding: 6rem 0;
    background: #f8fafc;
    position: relative;
}

.slider-container {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 80px;
}

.slider-wrapper {
    overflow: hidden;
    border-radius: 20px;
}

.slider-track {
    display: flex;
    transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
    will-change: transform;
}

.slide-item {
    flex: 0 0 25%;
    padding: 15px;
    box-sizing: border-box;
}


.gallery-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.card-image-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.gallery-card:hover .gallery-image {
    transform: scale(1.1);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(102, 126, 234, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-card:hover .image-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
}

.overlay-content i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}

.overlay-content span {
    font-size: 1rem;
    font-weight: 600;
}

.card-content {
    padding: 2rem 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.card-divider {
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 0 auto 1.5rem;
    border-radius: 2px;
}

.card-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 12px 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.card-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.card-btn i {
    transition: transform 0.3s ease;
}

.card-btn:hover i {
    transform: translateX(5px);
}

.card-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.gallery-card:hover .card-shine {
    left: 100%;
}


.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    height: 60px;
    background: white;
    border: none;
    border-radius: 50%;
    color: #667eea;
    font-size: 1.2rem;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    z-index: 10;
}

.slider-nav:hover {
    background: #667eea;
    color: white;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.3);
}

.prev-nav {
    left: 20px;
}

.next-nav {
    right: 20px;
}


.slider-pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 3rem;
}

.pagination-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
}

.pagination-dot.active {
    background: #667eea;
    transform: scale(1.2);
}

.pagination-dot:hover {
    background: #667eea;
    transform: scale(1.1);
}

/
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 4rem 2rem;
    text-align: center;
    width: 100%;
}

.empty-icon {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #4a5568;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #718096;
}


.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.shape {
    position: absolute;
    opacity: 0.1;
    animation: float 8s ease-in-out infinite;
}

.shape-1 {
    width: 80px;
    height: 80px;
    background: #667eea;
    border-radius: 50%;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    background: #764ba2;
    transform: rotate(45deg);
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    background: #667eea;
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    bottom: 30%;
    left: 20%;
    animation-delay: 4s;
}

.shape-4 {
    width: 70px;
    height: 70px;
    background: #764ba2;
    border-radius: 50%;
    top: 40%;
    right: 5%;
    animation-delay: 6s;
}


@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    33% {
        transform: translateY(-20px) rotate(120deg);
    }
    66% {
        transform: translateY(20px) rotate(240deg);
    }
}


@media (max-width: 1024px) {
    .slide-item {
        flex: 0 0 33.333%;
    }
    
    .slider-container {
        padding: 0 60px;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .title-icon {
        font-size: 1.8rem;
        margin: 0 0.5rem;
    }
    
    .slide-item {
        flex: 0 0 50%;
    }
    
    .slider-container {
        padding: 0 40px;
    }
    
    .slider-nav {
        width: 50px;
        height: 50px;
        font-size: 1rem;
    }
    
    .gallery-slider-section {
        padding: 4rem 0;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .slide-item {
        flex: 0 0 100%;
    }
    
    .slider-container {
        padding: 0 20px;
    }
    
    .prev-nav {
        left: 10px;
    }
    
    .next-nav {
        right: 10px;
    }
    
    .gallery-hero {
        padding: 6rem 0 3rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.slider-track');
    const slides = document.querySelectorAll('.slide-item');
    const prevBtn = document.querySelector('.prev-nav');
    const nextBtn = document.querySelector('.next-nav');
    const paginationContainer = document.querySelector('.slider-pagination');

    if (!slides.length) return;

    
    function getSlidesPerPage() {
        if (window.innerWidth <= 576) return 1;
        if (window.innerWidth <= 768) return 2;
        if (window.innerWidth <= 1024) return 3;
        return 4;
    }

    let slidesPerPage = getSlidesPerPage();
    const totalSlides = slides.length;
    let totalPages = Math.ceil(totalSlides / slidesPerPage);
    let currentPage = 0;

    
    function createPagination() {
        paginationContainer.innerHTML = '';
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('button');
            dot.className = 'pagination-dot';
            dot.setAttribute('aria-label', `Go to page ${i + 1}`);
            
            dot.addEventListener('click', () => {
                currentPage = i;
                updateSlider();
            });
            
            paginationContainer.appendChild(dot);
        }
    }

    
    function updateSlider() {
        if (currentPage < 0) currentPage = 0;
        if (currentPage >= totalPages) currentPage = totalPages - 1;

        const slideWidth = slides[0].getBoundingClientRect().width;
        const moveDistance = slideWidth * slidesPerPage * currentPage;
        
        track.style.transform = `translateX(-${moveDistance}px)`;

       
        const dots = paginationContainer.querySelectorAll('.pagination-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentPage);
        });

      
        prevBtn.style.opacity = currentPage === 0 ? '0.5' : '1';
        nextBtn.style.opacity = currentPage === totalPages - 1 ? '0.5' : '1';
        prevBtn.disabled = currentPage === 0;
        nextBtn.disabled = currentPage === totalPages - 1;
    }

  
    prevBtn.addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            updateSlider();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages - 1) {
            currentPage++;
            updateSlider();
        }
    });

    function handleResize() {
        const newSlidesPerPage = getSlidesPerPage();
        if (newSlidesPerPage !== slidesPerPage) {
            slidesPerPage = newSlidesPerPage;
            totalPages = Math.ceil(totalSlides / slidesPerPage);
            currentPage = 0;
            createPagination();
            updateSlider();
        }
    }

    
    let startX = 0;
    let currentX = 0;
    let isDragging = false;

    track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
    }, { passive: true });

    track.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
    }, { passive: true });

    track.addEventListener('touchend', () => {
        if (!isDragging) return;
        
        const diffX = startX - currentX;
        const threshold = 50;
        
        if (Math.abs(diffX) > threshold) {
            if (diffX > 0 && currentPage < totalPages - 1) {
                currentPage++;
            } else if (diffX < 0 && currentPage > 0) {
                currentPage--;
            }
            updateSlider();
        }
        
        isDragging = false;
    });

    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft' && currentPage > 0) {
            currentPage--;
            updateSlider();
        } else if (e.key === 'ArrowRight' && currentPage < totalPages - 1) {
            currentPage++;
            updateSlider();
        }
    });

    
    let autoPlayInterval;
    const autoPlayDelay = 5000;

    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            if (currentPage < totalPages - 1) {
                currentPage++;
            } else {
                currentPage = 0;
            }
            updateSlider();
        }, autoPlayDelay);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

   
    const sliderContainer = document.querySelector('.slider-container');
    sliderContainer.addEventListener('mouseenter', stopAutoPlay);
    sliderContainer.addEventListener('mouseleave', startAutoPlay);

    
    createPagination();
    updateSlider();
    startAutoPlay();

    
    window.addEventListener('resize', handleResize);
});
</script>