@extends('layouts.guest.app')    

@section('title', 'Alumni')

@section('content')
<div class="container-fluid titleArtikel py-4 text-center title-container">
    <div class="line-container">
        <hr class="solid-line">
        <h1 style="color: #003366; font-size: 2rem; font-weight: bold; display: inline-block;">ALUMNI</h1>
        <hr class="solid-line">
    </div>
</div>

<div class="container artikel">
    @forelse ($alumni as $person)
        <a href="{{ route('guest.alumni.detail', $person->id) }}" class="alumni-item text-decoration-none d-flex mb-4">
            <div class="alumni-image-wrapper">
                <img src="{{ $person->image ? asset('storage/' . $person->image) : asset('guest/images/default.jpg') }}" 
                    alt="Alumni {{ $person->name }}" class="alumni-image" />
            </div>

            <div class="textArtikel ms-3">
                <h3 class="alumni-name">{{ $person->name }}</h3>
                <p>
                    {!! \Illuminate\Support\Str::limit($person->description, 200, '...') !!}
                </p>
            </div>
        </a>
    @empty
        <p class="text-center text-muted">Belum ada data alumni tersedia.</p>
    @endforelse
</div>
@endsection

<style>
.title-container {
    margin-top: 45px; 
    margin-bottom: 40px; 
    max-width: 1140px;
    margin-left: auto;
    margin-right: auto;
}

.line-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    max-width: 300px;
    margin: 0 auto;
}

.solid-line {
    border-top: 2px solid #003366;
    width: 100px;
    margin: 0 10px;
    display: inline-block;
    vertical-align: middle;
}

.alumni-item {
    display: flex;
    align-items: flex-start;
    gap: 25px;
}

.alumni-image-wrapper {
    flex-shrink: 0;
    width: 150px;
    height: 150px;
    overflow: hidden;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.alumni-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

.textArtikel {
    margin-top: 10px; 
}

.alumni-name {
    font-weight: 600;
    font-size: 1.2rem;
    color: #003366;
    margin-bottom: 8px;
    transition: color 0.3s ease;
}

.alumni-name:hover {
    color: #fcb405;
    cursor: pointer;
}

.textArtikel p {
    margin: 0;
    color: #333;
    line-height: 1.4;
}
</style>
