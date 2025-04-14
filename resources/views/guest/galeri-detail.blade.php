
@extends('layouts.guest.app')

@section('title', $galeri->title)

@section('content')
<div class="title">
    <h2>{{ $galeri->title }}</h2>
</div>

<div class="container perGaleri">
    @php
        $images = json_decode($galeri->images, true);
    @endphp

    @if($images && count($images) > 0)
        @foreach ($images as $img)
            <img src="{{ asset('storage/' . $img) }}" alt="{{ $galeri->title }}">
        @endforeach
    @else
        <p class="text-center">Belum ada gambar untuk galeri ini.</p>
    @endif
</div>

<div class="container my-4">
    <p>{!! nl2br(e($galeri->description)) !!}</p>
</div>

@endsection
