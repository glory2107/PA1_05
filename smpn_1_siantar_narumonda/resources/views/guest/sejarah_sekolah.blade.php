@extends('layouts.guest.app')

@section('title', 'Sejarah Singkat')

@section('content')
<div class="container mt-3 pt-3">
    <div class="mx-auto" style="max-width: 900px;">
        @foreach ($sejarahSekolahs as $sejarah)
            {{-- Gambar --}}
            @if ($sejarah->image)
                <div class="mb-3 text-start image-container">
                    <img src="{{ asset('storage/' . $sejarah->image) }}" alt="{{ $sejarah->title }}" 
                        style="width: 100%; height: auto; object-fit: cover; max-height: 420px;">
                </div>

                {{-- Garis horizontal full width --}}
                <div class="full-width-hr-wrapper">
                    <hr class="image-hr" />
                </div>
            @endif

             {{-- Judul --}}
            <h4 class="font-weight-bold mb-4 text-start" style="color: #003366;">
                {{ $sejarah->title }}
            </h4>

            {{-- Deskripsi --}}
            <div class="text-justify" style="color: #4a4a4a; margin-bottom: 3rem;">
                {!! $sejarah->description !!}
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>

.image-hr {
    border: none;
    border-bottom: 2.5px solid #e8e4e4;
    margin: 2.5rem 0 2rem 0;
    width: 100%;
}
</style>
