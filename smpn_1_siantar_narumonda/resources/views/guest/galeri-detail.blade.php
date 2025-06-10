@extends('layouts.guest.app')

@section('title', $galeri->title)

@section('content')
<style>
.title {
    margin-top: 0;
    padding-top: 0;
    text-align: center;
}

.title h2 {
    display: inline-block;
    position: relative;
    margin-top: 50px; 
    font-weight: bold;
    font-size: 32px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #003366;
    padding: 0 30px;
}

    .perGaleri {
        padding: 40px 0;
    }

    .galeri-img {
        overflow: hidden;
        border-radius: 0px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        position: relative;
        display: block;
        cursor: pointer;
    }

    .galeri-img img {
        border-radius: 0px;
        width: 100%;
        height: 260px;
        object-fit: cover;
        transform: scale(1.05);
        transition: transform 0.4s ease-in-out;
    }

    
    .galeri-img::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(64, 64, 64, 0.7);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 1;
    }

    
    .galeri-img::after {
        content: "🔍";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 16px;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 2;
        pointer-events: none;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    
    .galeri-img:hover::before {
        opacity: 1;
    }

    .galeri-img:hover::after {
        opacity: 1;
    }

    .galeri-img:hover img {
        transform: scale(1.1);
    }

    .galeri-description {
        text-align: justify;
        font-size: 16px;
        color: #444;
        line-height: 1.8;
    }
    

    
    .custom-lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.92);
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .custom-lightbox.active {
        display: flex;
        opacity: 1;
        align-items: center;
        justify-content: center;
    }

    .lightbox-main {
        display: flex;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .lightbox-image-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 10px 10px 10px 10px;
    }

   
    .lightbox-image-container.fullscreen-mode {
        padding: 0;
        width: 100vw;
        height: 100vh;
    }

    .lightbox-content {
        position: relative;
        max-width: 100%;
        max-height: 100%;
        overflow: hidden;
        cursor: grab;
        flex-grow: 1; 
        display: flex; 
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .lightbox-content:active {
        cursor: grabbing;
    }

    .lightbox-content.zoomed {
        cursor: move;
    }

    .lightbox-image {
        width: 100%;
        height: auto;
        max-height: 75vh;
        object-fit: contain;
        border-radius: 0px; 
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.8);
        transition: transform 0.3s ease, opacity 0.3s ease; 
        user-select: none;
        -webkit-user-drag: none;
    }

    
    .lightbox-image.fullscreen-image {
        max-width: 100vw;
        max-height: 100vh;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 0px;
    }

    
    .lightbox-sidebar {
        width: 200px;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 80px 10px 20px 10px;
        overflow-y: auto;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        transform: translateX(0); 
        transition: transform 0.3s ease-in-out;
    }

    .lightbox-sidebar.hidden {
        transform: translateX(100%);
    }

    .thumbnail-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .thumbnail-item {
        width: 100%;
        height: 100px;
        border-radius: 0px; 
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        opacity: 0.7;
    }

    .thumbnail-item.active {
        border-color: #007bff;
        opacity: 1;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .thumbnail-item:hover img {
        transform: scale(1.1);
    }

    .thumbnail-item:hover {
        opacity: 1;
    }

    
    .lightbox-header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        display: flex;
        align-items: center;
        justify-content: flex-end; 
        padding: 0 20px;
        z-index: 10;
    }

    
    .lightbox-nav-group {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 100px; 
        z-index: 6;
    }

    
    .lightbox-counter {
        position: absolute;
        top: 20px; 
        left: 20px; 
        color: white;
        font-size: 16px;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 8px 15px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        white-space: nowrap;
        z-index: 10; 
    }

    .lightbox-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }

   
    .control-btn {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .control-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .control-btn.active {
        background-color: rgba(0, 123, 255, 0.8);
    }

    
    .lightbox-nav {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        width: 45px; 
        height: 45px; 
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-nav:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    
    .zoom-controls {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10px;
        border-radius: 25px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        z-index: 10;
    }

    .zoom-btn {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zoom-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

   
    .custom-lightbox.fullscreen {
        background-color: rgba(0, 0, 0, 1);
    }

    .custom-lightbox.fullscreen .lightbox-header,
    .custom-lightbox.fullscreen .lightbox-nav-group,
    .custom-lightbox.fullscreen .zoom-controls,
    .custom-lightbox.fullscreen .lightbox-counter { 
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

   
    .custom-lightbox.fullscreen:hover .lightbox-header,
    .custom-lightbox.fullscreen:hover .lightbox-nav-group, 
    .custom-lightbox.fullscreen:hover .zoom-controls,
    .custom-lightbox.fullscreen:hover .lightbox-counter { 
        opacity: 1;
        pointer-events: auto;
    }

    .custom-lightbox.fullscreen .lightbox-sidebar {
        display: none;
    }

    .custom-lightbox.fullscreen .lightbox-image-container {
        padding: 0;
        width: 100vw;
        height: 100vh;
    }

    .custom-lightbox.fullscreen .lightbox-image {
        max-width: 100vw;
        max-height: 100vh;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 0px;
    }

    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    
    .slideshow-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background-color: rgba(0, 123, 255, 0.8);
        transition: width 0.1s linear;
        border-radius: 0 3px 0 0;
    }

    
    @media (max-width: 768px) {
        .galeri-img img {
            height: 200px;
        }
        
        .title h2 {
            font-size: 24px;
        }

        .lightbox-sidebar {
            width: 150px;
            padding: 60px 5px 20px 5px;
        }

        .thumbnail-item {
            height: 80px;
        }

        
        .lightbox-nav-group {
            gap: 5px;
            padding: 0 10px;
        }

        .lightbox-nav {
            width: 35px;
            height: 35px;
            font-size: 18px;
        }

        .lightbox-counter {
            font-size: 14px;
            padding: 6px 12px;
            top: 15px; 
            left: 15px;
        }

        .control-btn {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }

        .zoom-controls {
            bottom: 15px;
            padding: 8px;
        }

        .zoom-btn {
            width: 30px;
            height: 30px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .lightbox-sidebar {
            display: none;
        }

       
        .lightbox-nav-group {
            top: auto; 
            bottom: 60px; 
            transform: translateX(-50%); 
            width: 90%; 
            padding: 0; 
        }
        
       
        .lightbox-image-container {
            padding: 60px 10px 10px 10px;
        }

        
        .lightbox-header {
            justify-content: center; 
        }
    }

   
    .fullscreen-auto-hide {
        cursor: none;
    }

    .fullscreen-auto-hide .lightbox-header,
    .fullscreen-auto-hide .lightbox-nav-group, 
    .fullscreen-auto-hide .zoom-controls,
    .fullscreen-auto-hide .lightbox-counter { 
        opacity: 0;
        pointer-events: none;
    }
</style>

<div class="title">
    <h2>{{ $galeri->title }}</h2>
</div>

<div class="container perGaleri">
    @php
        $images = json_decode($galeri->images, true);
    @endphp

    @if($images && count($images) > 0)
        <div class="row">
            @foreach ($images as $index => $img)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="galeri-img" data-index="{{ $index }}">
                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $galeri->title }}">
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Belum ada gambar untuk galeri ini.</p>
    @endif
</div>

<div class="container my-4 galeri-description">
    <p>{!! nl2br($galeri->description) !!}</p>
</div>

<div class="custom-lightbox" id="customLightbox">
    <div class="lightbox-header">
        <div class="lightbox-controls">
            <button class="control-btn" id="playPause" title="Play/Pause Slideshow">▶</button>
            <button class="control-btn active" id="galleryToggle" title="Show/Hide Gallery">⊞</button>
            <button class="control-btn" id="fullscreenBtn" title="Toggle Fullscreen">⛶</button>
            <button class="control-btn" id="closeLightbox" title="Close">×</button>
        </div>
    </div>

    <div class="lightbox-main">
        <div class="lightbox-image-container">
            
            <div class="lightbox-counter" id="lightboxCounter">1 of {{ count($images ?? []) }}</div>

            <div class="lightbox-nav-group">
                <button class="lightbox-nav" id="prevImage">‹</button>
                <button class="lightbox-nav" id="nextImage">›</button>
            </div>

            <div class="lightbox-content" id="lightboxContent">
                <img class="lightbox-image" id="lightboxImage" src="" alt="">
                <div class="slideshow-progress" id="slideshowProgress"></div>
            </div>

            <div class="zoom-controls">
                <button class="zoom-btn" id="zoomOut" title="Zoom Out">−</button>
                <button class="zoom-btn" id="zoomReset" title="Reset Zoom">⌂</button>
                <button class="zoom-btn" id="zoomIn" title="Zoom In">+</button>
            </div>
        </div>

        <div class="lightbox-sidebar" id="lightboxSidebar">
            <div class="thumbnail-grid" id="thumbnailGrid">
                </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const images = @json($images);
        const galeriTitle = @json($galeri->title);
        const galleryImages = document.querySelectorAll('.galeri-img');
        const lightbox = document.getElementById('customLightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxContent = document.getElementById('lightboxContent');
        const lightboxCounter = document.getElementById('lightboxCounter');
        const closeLightbox = document.getElementById('closeLightbox');
        const prevImage = document.getElementById('prevImage');
        const nextImage = document.getElementById('nextImage');
        const thumbnailGrid = document.getElementById('thumbnailGrid');
        const playPauseBtn = document.getElementById('playPause');
        const galleryToggleBtn = document.getElementById('galleryToggle');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const lightboxSidebar = document.getElementById('lightboxSidebar');
        const lightboxImageContainer = document.querySelector('.lightbox-image-container');
        const zoomInBtn = document.getElementById('zoomIn');
        const zoomOutBtn = document.getElementById('zoomOut');
        const zoomResetBtn = document.getElementById('zoomReset');
        const slideshowProgress = document.getElementById('slideshowProgress');
        
        let currentIndex = 0;
        let isGalleryVisible = true; 
        let isPlaying = false;
        let slideshowInterval;
        let currentZoom = 1;
        let isDragging = false;
        let dragStart = { x: 0, y: 0 };
        let imageOffset = { x: 0, y: 0 };
        const slideshowDuration = 3000; 
        let progressInterval;
        let fullscreenHideTimeout;

       
        function initThumbnails() {
            thumbnailGrid.innerHTML = '';
            images.forEach((img, index) => {
                const thumbnailItem = document.createElement('div');
                thumbnailItem.className = 'thumbnail-item';
                if (index === 0) thumbnailItem.classList.add('active');
                
                const thumbnailImg = document.createElement('img');
                thumbnailImg.src = "{{ asset('storage/') }}/" + img;
                thumbnailImg.alt = galeriTitle;
                
                thumbnailItem.appendChild(thumbnailImg);
                thumbnailItem.addEventListener('click', () => goToImage(index));
                thumbnailGrid.appendChild(thumbnailItem);
            });
        }

        
        galleryImages.forEach((img, index) => {
            img.addEventListener('click', function () {
                currentIndex = index;
                openLightbox();
            });
        });

        function openLightbox() {
            lightbox.classList.add('active');
            initThumbnails();
            updateLightboxImage();
            document.body.style.overflow = 'hidden';
            resetZoom();
            
            lightboxSidebar.classList.remove('hidden');
            isGalleryVisible = true;
            galleryToggleBtn.classList.add('active');
        }

        function closeLightboxFn() {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
            stopSlideshow();
            resetZoom();
            exitFullscreen();
        }

        function updateLightboxImage(direction = null) {
           
            lightboxImage.classList.remove('fade-in');
            lightboxImage.style.opacity = '0'; 

            
            const nextImageSrc = "{{ asset('storage/') }}/" + images[currentIndex];
            const tempImage = new Image();
            tempImage.src = nextImageSrc;

            tempImage.onload = () => {
                lightboxImage.src = nextImageSrc;
                lightboxCounter.textContent = `${currentIndex + 1} of ${images.length}`;
                
                
                document.querySelectorAll('.thumbnail-item').forEach((item, index) => {
                    item.classList.toggle('active', index === currentIndex);
                });

                
                lightboxImage.classList.add('fade-in');
                lightboxImage.style.opacity = '1';

                resetZoom();
            };
        }

        function goToImage(index) {
            currentIndex = index;
            updateLightboxImage();
        }

        function nextImageFn() {
            currentIndex = (currentIndex + 1) % images.length;
            updateLightboxImage();
        }

        function prevImageFn() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateLightboxImage();
        }

        
        function startSlideshow() {
            if (isPlaying) return;
            isPlaying = true;
            playPauseBtn.textContent = '⏸';
            playPauseBtn.classList.add('active');
            
            let progress = 0;
            slideshowProgress.style.width = '0%'; 
            progressInterval = setInterval(() => {
                progress += 100;
                const percentage = (progress / slideshowDuration) * 100;
                slideshowProgress.style.width = percentage + '%';
            }, 100);
            
            slideshowInterval = setInterval(() => {
                nextImageFn();
                progress = 0;
                slideshowProgress.style.width = '0%';
            }, slideshowDuration);
        }

        function stopSlideshow() {
            if (!isPlaying) return;
            isPlaying = false;
            playPauseBtn.textContent = '▶';
            playPauseBtn.classList.remove('active');
            clearInterval(slideshowInterval);
            clearInterval(progressInterval);
            slideshowProgress.style.width = '0%';
        }

        function toggleSlideshow() {
            if (isPlaying) {
                stopSlideshow();
            } else {
                startSlideshow();
            }
        }

        
        function toggleGallery() {
            isGalleryVisible = !isGalleryVisible;
            if (isGalleryVisible) {
                lightboxSidebar.classList.remove('hidden');
                galleryToggleBtn.classList.add('active');
            } else {
                lightboxSidebar.classList.add('hidden');
                galleryToggleBtn.classList.remove('active');
            }
        }

        
        function toggleFullscreen() {
            if (lightbox.classList.contains('fullscreen')) {
                exitFullscreen();
            } else {
                enterFullscreen();
            }
        }

        function enterFullscreen() {
            lightbox.classList.add('fullscreen');
            lightboxImageContainer.classList.add('fullscreen-mode');
            lightboxImage.classList.add('fullscreen-image');
            
            
            lightboxSidebar.classList.add('hidden');
            
            
            if (lightbox.requestFullscreen) {
                lightbox.requestFullscreen();
            } else if (lightbox.mozRequestFullScreen) {
                lightbox.mozRequestFullScreen();
            } else if (lightbox.webkitRequestFullscreen) {
                lightbox.webkitRequestFullscreen();
            } else if (lightbox.msRequestFullscreen) {
                lightbox.msRequestFullscreen();
            }

           
            startFullscreenAutoHide();
        }

        function exitFullscreen() {
            lightbox.classList.remove('fullscreen', 'fullscreen-auto-hide');
            lightboxImageContainer.classList.remove('fullscreen-mode');
            lightboxImage.classList.remove('fullscreen-image');
            
            
            if (isGalleryVisible) {
                lightboxSidebar.classList.remove('hidden');
            }
            
            
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }

            clearTimeout(fullscreenHideTimeout);
        }

        function startFullscreenAutoHide() {
            clearTimeout(fullscreenHideTimeout);
            lightbox.classList.remove('fullscreen-auto-hide');
            
            fullscreenHideTimeout = setTimeout(() => {
                if (lightbox.classList.contains('fullscreen')) {
                    lightbox.classList.add('fullscreen-auto-hide');
                }
            }, 3000);
        }

        
        lightbox.addEventListener('mousemove', () => {
            if (lightbox.classList.contains('fullscreen')) {
                startFullscreenAutoHide();
            }
        });

        
        function zoomIn() {
            currentZoom = Math.min(currentZoom * 1.3, 5);
            applyZoom();
        }

        function zoomOut() {
            currentZoom = Math.max(currentZoom / 1.3, 0.5);
            applyZoom();
        }

        function resetZoom() {
            currentZoom = 1;
            imageOffset = { x: 0, y: 0 };
            applyZoom();
            lightboxContent.classList.remove('zoomed');
        }

        function applyZoom() {
            lightboxImage.style.transform = `scale(${currentZoom}) translate(${imageOffset.x}px, ${imageOffset.y}px)`;
            if (currentZoom > 1) {
                lightboxContent.classList.add('zoomed');
            } else {
                lightboxContent.classList.remove('zoomed');
                imageOffset = { x: 0, y: 0 };
            }
        }

        
        function startDrag(e) {
            if (currentZoom <= 1) return;
            isDragging = true;
            const clientX = e.clientX || (e.touches && e.touches[0].clientX);
            const clientY = e.clientY || (e.touches && e.touches[0].clientY);
            dragStart = { 
                x: clientX - imageOffset.x, 
                y: clientY - imageOffset.y 
            };
            e.preventDefault();
        }

        function drag(e) {
            if (!isDragging || currentZoom <= 1) return;
            const clientX = e.clientX || (e.touches && e.touches[0].clientX);
            const clientY = e.touches && e.touches[0].clientY ? e.touches[0].clientY : e.clientY;
            imageOffset = {
                x: clientX - dragStart.x,
                y: clientY - dragStart.y
            };
            applyZoom();
            e.preventDefault();
        }

        function endDrag() {
            isDragging = false;
        }

        
        closeLightbox.addEventListener('click', closeLightboxFn);
        nextImage.addEventListener('click', nextImageFn);
        prevImage.addEventListener('click', prevImageFn);
        playPauseBtn.addEventListener('click', toggleSlideshow);
        galleryToggleBtn.addEventListener('click', toggleGallery);
        fullscreenBtn.addEventListener('click', toggleFullscreen);
        zoomInBtn.addEventListener('click', zoomIn);
        zoomOutBtn.addEventListener('click', zoomOut);
        zoomResetBtn.addEventListener('click', resetZoom);

        
        lightboxContent.addEventListener('mousedown', startDrag);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', endDrag);

       
        lightboxContent.addEventListener('touchstart', startDrag, { passive: false });
        document.addEventListener('touchmove', drag, { passive: false });
        document.addEventListener('touchend', endDrag);

        /
        lightboxContent.addEventListener('wheel', function(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        });

        
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                closeLightboxFn();
            }
        });

        
        document.addEventListener('keydown', function(e) {
            if (lightbox.classList.contains('active')) {
                switch(e.key) {
                    case 'Escape':
                        closeLightboxFn();
                        break;
                    case 'ArrowLeft':
                        prevImageFn();
                        break;
                    case 'ArrowRight':
                        nextImageFn();
                        break;
                    case ' ':
                        e.preventDefault();
                        toggleSlideshow();
                        break;
                    case 'g':
                    case 'G':
                        toggleGallery();
                        break;
                    case 'f':
                    case 'F':
                        toggleFullscreen();
                        break;
                    case '+':
                    case '=':
                        zoomIn();
                        break;
                    case '-':
                        zoomOut();
                        break;
                    case '0':
                        resetZoom();
                        break;
                }
            }
        });

        
        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartY = 0;
        let touchEndY = 0;

        lightbox.addEventListener('touchstart', function(e) {
            if (currentZoom > 1) return; 
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
        });

        lightbox.addEventListener('touchend', function(e) {
            if (currentZoom > 1) return; 
            touchEndX = e.changedTouches[0].screenX;
            touchEndY = e.changedTouches[0].screenY;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diffX = touchStartX - touchEndX;
            const diffY = Math.abs(touchStartY - touchEndY);
            
            if (Math.abs(diffX) > swipeThreshold && diffY < swipeThreshold) {
                if (diffX > 0) {
                   
                    nextImageFn();
                } else {
                   
                    prevImageFn();
                }
            }
        }

        
        let initialDistance = 0;
        let initialZoom = 1;

        lightboxContent.addEventListener('touchstart', function(e) {
            if (e.touches.length === 2) {
                e.preventDefault();
                initialDistance = getDistance(e.touches[0], e.touches[1]);
                initialZoom = currentZoom;
            }
        });

        lightboxContent.addEventListener('touchmove', function(e) {
            if (e.touches.length === 2) {
                e.preventDefault();
                const currentDistance = getDistance(e.touches[0], e.touches[1]);
                const scale = currentDistance / initialDistance;
                currentZoom = Math.max(0.5, Math.min(5, initialZoom * scale));
                applyZoom();
            }
        });

        function getDistance(touch1, touch2) {
            const dx = touch1.clientX - touch2.clientX;
            const dy = touch1.clientY - touch2.clientY;
            return Math.sqrt(dx * dx + dy * dy);
        }
    });
</script>
@endsection