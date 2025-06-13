@extends('layouts.guest.app')  

@section('title', 'Detail Alumni - ' . $alumni->name)

@section('content')
<div class="alumni-detail-wrapper">
    <!-- Hero Section with Background Pattern -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Alumni Image -->
                <div class="col-lg-4 col-md-5 text-center mb-4 mb-md-0">
                    <div class="alumni-image-container">
                        @if ($alumni->image)
                            <img src="{{ asset('storage/' . $alumni->image) }}" alt="{{ $alumni->name }}" 
                                class="alumni-image" />
                        @else
                            <div class="alumni-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="image-shadow"></div>
                    </div>
                </div>

                <!-- Alumni Info -->
                <div class="col-lg-8 col-md-7">
                    <div class="alumni-info">
                        <div class="badge-container">
                        </div>
                        <h1 class="alumni-name">{{ $alumni->name }}</h1>
                        @if ($alumni->position)
                            <p class="alumni-position">
                                <i class="fas fa-briefcase me-2"></i>
                                {{ $alumni->position }}
                            </p>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni Section -->
    <div class="testimoni-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        
                        <div class="section-header text-center mb-4">
                            <h2 class="testimoni-title">Testimoni Alumni</h2>
                            <div class="title-underline"></div>
                        </div>

                        <div class="testimoni-content">
                            <p class="testimoni-description">
                                {!! $alumni->description !!}
                            </p>
                        </div>

                        <div class="author-signature">
                            <div class="signature-line"></div>
                            <span class="signature-name">{{ $alumni->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="floating-elements">
        <div class="floating-circle circle-1"></div>
        <div class="floating-circle circle-2"></div>
        <div class="floating-circle circle-3"></div>
    </div>
</div>
@endsection

<style>
.alumni-detail-wrapper {
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}


.hero-section {
    background: linear-gradient(135deg, #667eea 0%,rgb(48, 55, 128) 100%);
    padding: 8rem 0 6rem;
    position: relative;
    margin-top: -2rem;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}


.alumni-image-container {
    position: relative;
    display: inline-block;
}

.alumni-image {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 20px;
    border: 4px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.alumni-image:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

.alumni-placeholder {
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.7);
    border: 4px solid rgba(255, 255, 255, 0.2);
}

.image-shadow {
    position: absolute;
    top: 15px;
    left: 15px;
    width: 200px;
    height: 200px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 20px;
    z-index: 1;
}


.alumni-info {
    color: white;
    position: relative;
    z-index: 2;
}

.badge-container {
    margin-bottom: 1rem;
}

.alumni-badge {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.alumni-name {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #fff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.alumni-position {
    font-size: 1.3rem;
    font-weight: 500;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
    color: white;
}


.testimoni-section {
    padding: 6rem 0;
    background: #f8f9fa;
    position: relative;
}

.testimoni-card {
    background: white;
    border-radius: 25px;
    padding: 4rem 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.quote-icon {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.section-header {
    margin-bottom: 3rem;
}

.testimoni-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1rem;
}

.title-underline {
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 0 auto;
    border-radius: 2px;
}

.testimoni-content {
    margin-bottom: 3rem;
}

.testimoni-description {
    font-size: 1.2rem;
    line-height: 2;
    color: #4a5568;
    text-align: justify;
    font-weight: 400;
    position: relative;
}

.testimoni-description::before {
    content: '"';
    font-size: 4rem;
    color: #e2e8f0;
    position: absolute;
    top: -20px;
    left: -20px;
    font-family: serif;
}

.testimoni-description::after {
    content: '"';
    font-size: 4rem;
    color: #e2e8f0;
    position: absolute;
    bottom: -40px;
    right: -10px;
    font-family: serif;
}

.author-signature {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 1rem;
}

.signature-line {
    width: 100px;
    height: 2px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 1px;
}

.signature-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3748;
    font-style: italic;
}

.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.floating-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.1);
    animation: float 6s ease-in-out infinite;
}

.circle-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    right: 10%;
    animation-delay: 0s;
}

.circle-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    left: 15%;
    animation-delay: 2s;
}

.circle-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    right: 20%;
    animation-delay: 4s;
}


@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}


@media (max-width: 768px) {
    .hero-section {
        padding: 6rem 0 4rem;
    }
    
    .alumni-name {
        font-size: 2.2rem;
    }
    
    .alumni-image {
        width: 150px;
        height: 150px;
    }
    
    .image-shadow {
        width: 150px;
        height: 150px;
    }
    
    .testimoni-card {
        padding: 2.5rem 1.5rem;
        margin: 0 1rem;
    }
    
    .testimoni-title {
        font-size: 2rem;
    }
    
    .testimoni-description {
        font-size: 1.1rem;
    }
    
    .alumni-info {
        text-align: center;
        margin-top: 2rem;
    }
    
    .social-links {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .alumni-name {
        font-size: 1.8rem;
    }
    
    .testimoni-description {
        font-size: 1rem;
        line-height: 1.8;
    }
    
    .quote-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>