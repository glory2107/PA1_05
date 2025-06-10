@extends('layouts.guest.app')    

@section('title', $kataSambutans->isNotEmpty() ? $kataSambutans->first()->title : 'Kata Sambutan')

@section('content')
<div class="container mt-3 pt-3">
    <div class="mx-auto" style="max-width: 900px;">
        @foreach ($kataSambutans as $kataSambutan)
            {{-- Gambar --}}
            @if ($kataSambutan->image)
                <div class="mb-3 text-start image-container">
                    <img src="{{ asset('storage/' . $kataSambutan->image) }}" alt="{{ $kataSambutan->title }}" 
                        style="width: 100%; height: auto; object-fit: cover; max-height: 420px;">
                </div>

                {{-- Garis horizontal full width --}}
                <div class="full-width-hr-wrapper">
                    <hr class="image-hr" />
                </div>
            @endif

           

            {{-- Deskripsi --}}
            <div class="text-justify" style="color: #4a4a4a;">
                {!! $kataSambutan->description !!}
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
