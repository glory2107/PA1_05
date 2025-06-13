@extends('layouts.guest.app')       

@section('title', 'Tenaga Kerja')

@section('content')
    <div class="page-wrapper-tenagakerja">
        <div class="container-fluid titleArtikel py-4 text-center" style="margin-top: 0px; max-width: 1140px;">
            <div class="line-container">
                <hr class="solid-line">
                <h1 style="color: #003366; font-size: 2rem; font-weight: bold; display: inline-block;">TENAGA KERJA</h1>
                <hr class="solid-line">
            </div>
        </div>

        <div class="container-fluid" style="max-width: 1140px;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 justify-content-center">
                @forelse ($tenagaKerja as $person)
                    <div class="col d-flex card-spacing">
                        <div class="staff-card">
                            <div class="staff-photo-container">
                                <div class="photo-line"></div> <!-- Garis horizontal kiri -->
                                <img src="{{ $person->image ? asset('storage/' . $person->image) : asset('guest/images/default.jpg') }}"
                                     class="staff-photo"
                                     alt="{{ $person->name }}">
                                <div class="photo-line"></div> <!-- Garis horizontal kanan -->
                            </div>
                            <div class="staff-info">
                                <h5 class="staff-name">{{ $person->name }}</h5>
                                <p class="staff-position">{{ $person->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Belum ada data tenaga kerja tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

<style>
    .page-wrapper-tenagakerja {
        background-color: #f2f2f2;
        padding-top: 20px;
        padding-bottom: 20px;
        min-height: 100vh;
    }

    .staff-card {
        background-color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 15px;
        width: 100%;
        max-width: 250px;
        margin: 0 auto;
        text-align: center;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }
    
    .staff-card:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .staff-photo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .photo-line {
        height: 3px;
        flex-grow: 1;
        background-color: rgb(195, 181, 181); 
        margin: 0 10px; 
    }

    .staff-photo {
        width: 120px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        background-color: rgb(179, 170, 170); 
    }

    .staff-info {
        padding: 10px 5px;
    }

    .staff-name {
        color: #333;
        font-size: 1rem; 
        font-weight: 500; 
        margin-bottom: 5px;
    }

    .staff-id {
        color: #666;
        font-size: 0.8rem;
        margin-bottom: 5px;
    }

    .staff-position {
        color: #666;
        font-size: 0.9rem;
    }

    .solid-line {
        border-top: 2px solid #003366;
        width: 100px;
        margin: 0 10px;
        display: inline-block;
        vertical-align: middle;
    }

    .card-spacing {
        margin-top: 15px;
        margin-bottom: 15px;
    }
</style>
