@extends('layouts.guest.app')

@section('title', 'Galeri')

@section('content')
<div class="title">
    <h1 class="text-center">Galeri Kami</h1>
    <p class="text-center">Pilih Kategori Untuk Melihat Galeri Kami</p>
</div>

<div class="container">
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($galeri as $item)
                <tr>
                    <td>
                        @if ($item->image)
                            <img width="100" height="50" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        @else
                            <img width="100" height="50" src="{{ asset('guest/images/default.jpg') }}" alt="Default">
                        @endif
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <a href="{{ route('guest.galeri.detail', $item->id) }}" class="btn btn-primary">Selengkapnya</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada galeri ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
