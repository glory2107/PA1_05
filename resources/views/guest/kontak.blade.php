@extends('layouts.guest.app')

@section('title', 'Hubungi Kami | SMK N 2 Purbalingga')

@section('content')
<section class="pt-7" style="margin-top: 20px;">
    <div class="container-fluid titleArtikel py-4 text-center" style="margin-top: 0px; max-width: 1140px;">
        <div class="line-container d-flex justify-content-center align-items-center mb-4">
            <hr class="solid-line">
            <h1 class="mx-3" style="color: #003366; font-size: 2rem; font-weight: bold;">Hubungi Kami</h1>
            <hr class="solid-line">
        </div>
    </div>

    <div class="container" style="max-width: 1140px;">
        <div class="row gx-4">
            <!-- Denah Lokasi -->
            <div class="col-md-6">
                <h5 style="color: #003366; font-weight: 600; margin-bottom: 1rem;">Lokasi</h5>
                <div class="map-responsive">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.2307316401584!2d99.17727927472748!3d2.4299365975490925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031fffd46ea54db%3A0xb02f329d28038c86!2sSMP.N%201%20Siantar%20Narumonda!5e0!3m2!1sid!2sid!4v1743496914989!5m2!1sid!2sid" 
                        width="100%" 
                        height="550" 
                        style="border:0; border-radius: 4px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-md-6">
                <h5 style="color: #003366; font-weight: 600; margin-bottom: 1.5rem;">Kontak</h5>
                @forelse ($kontaks as $kontak)
                    <div class="kontak-item">
                        <div class="icon-box">
                            <i class="{{ $kontak->icon }}" style="font-size: 1.6rem; color: #003366;"></i>
                        </div>
                        <div class="kontak-text">
                            {!! nl2br(e($kontak->value)) !!}
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada informasi kontak yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .solid-line {
        border-top: 2px solid #003366;
        width: 80px;
        margin: 0 8px;
        display: inline-block;
        vertical-align: middle;
    }

    .map-responsive {
    overflow: hidden;
    position: relative;
    height: 400px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    padding-bottom: 0; 
}


    .map-responsive iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
        border-radius: 8px;
    }

    .kontak-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        background-color: #e0e4f1;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        margin-right: 16px;
    }

    .kontak-text {
        font-size: 1rem;
        color: #1a1a1a;
        word-wrap: break-word;
    }

    
    .col-md-6:last-child {
        padding-left: 50px;
    }
</style>
