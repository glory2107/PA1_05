@extends('layouts.guest.app')

@section('title', 'Ekstrakurikuler SMP 1 Siantar Narumonda')

@section('content')

<div class="title">
    <h1 class="text-center">Ekstrakurikuler Kami</h1>
    <p class="text-center">Beberapa Ekstrakurikuler Yang Dimiliki SMK N 2 Purbalingga</p>
</div>

<div class="container ekstrakurikuler">
    @foreach ($ekstrakurikuler as $item)
        <a href="{{ route('guest.ekstrakurikuler.detail', $item->id) }}" class="perEkstrakurikuler">
            <p>{{ $item->name }}</p>
        </a>
    @endforeach
</div>

@endsection
