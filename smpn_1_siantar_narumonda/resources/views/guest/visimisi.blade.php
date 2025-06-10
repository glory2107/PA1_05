@extends('layouts.guest.app')

@section('title', 'Visi Misi')

@section('content')
    <div class="kepsek pt-4">
        <div class="container-fluid px-5">
            @foreach ($profils as $profil)
                {{-- Wrapper full width dengan background --}}
                <div class="bg-fullwidth mb-4">
                    {{-- Container isi agar konten tidak melebar penuh --}}
                    <div class="card-custom-dark">
                        <div class="row no-gutters align-items-center">
                            @if ($profil->image)
                                <div class="col-md-4 d-flex justify-content-center">
                                    <img src="{{ asset('storage/' . $profil->image) }}" alt="{{ $profil->title }}" class="img-no-card">
                                </div>
                            @endif

                            <div class="col-md-8 {{ $profil->image ? '' : 'col-md-12' }}">
                                <div class="card-body">
                                    <h5 class="card-title text-custom-light text-center enlarged-title">{{ $profil->title }}</h5>
                                    <p class="card-text text-custom-light">{!! $profil->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    
    .bg-fullwidth {
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
        background-color: #ffffff;
    }

    
    .card-custom-dark {
        background: transparent !important;
        max-width: 1300px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        color: rgb(56, 52, 52) !important;
        border-radius: 0;
    }

    
    .text-custom-light {
        color: #04346c !important;
    }

    
    .enlarged-title {
        font-size: 2rem !important;
        font-weight: 700 !important;
        margin-bottom: 20px !important;
    }

    
    .card-body > p {
        margin-top: 20px !important;
    }

    
    .text-center {
        text-align: center !important;
    }

   
    .img-no-card {
        width: 400px;
        height: auto;
        object-fit: cover;
        margin: 0 auto;
        display: block;
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
    }

    
    .no-gutters {
        margin-left: 0 !important;
        margin-right: 0 !important;
        display: flex !important;
        align-items: center !important;
    }

    
    .card-body {
        padding: 2rem 2rem !important;
    }

    .kepsek > h1 {
        display: none !important;
    }
</style>
