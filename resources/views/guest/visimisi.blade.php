@extends('layouts.guest.app')

@section('title', 'Visi Misi')

@section('content')
    <div class="kepsek mt-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($profils as $profil)
                    <div class="col-12 col-md-8 mb-5">
                        <div class="card shadow-sm border-0">
                            {{-- Gambar di atas --}}
                            @if ($profil->image)
                                <img src="{{ asset('storage/' . $profil->image) }}" class="card-img-top img-fluid rounded-top" alt="Gambar Profil">
                            @endif

                            {{-- Konten teks --}}
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $profil->title }}</h5>
                                <p class="card-text" style="white-space: pre-line;">{!! nl2br(e($profil->description)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
