@extends('layouts.guest.app')

@section('title', 'Hubungi Kami | SMK N 2 Purbalingga')

@section('content')
<div class="container kontak mt-5 pt-5">
    <h3 class="mb-4">Hubungi Kami</h3>

    @forelse ($kontaks as $kontak)
        <div class="mb-2">
            <i class="{{ $kontak->icon }} me-2"></i> {{-- Misalnya fontawesome: fas fa-envelope --}}
            {{ $kontak->value }}
        </div>
    @empty
        <p class="text-muted">Belum ada informasi kontak yang tersedia.</p>
    @endforelse

    {{-- Map --}}
    <div class="mt-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.2307316401584!2d99.17727927472748!3d2.4299365975490925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031fffd46ea54db%3A0xb02f329d28038c86!2sSMP.N%201%20Siantar%20Narumonda!5e0!3m2!1sid!2sid!4v1743496914989!5m2!1sid!2sid" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
@endsection
