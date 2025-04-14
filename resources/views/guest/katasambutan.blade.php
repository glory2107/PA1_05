@extends('layouts.guest.app')

@section('title', 'Kata Sambutan')

@section('content')
    <div class="kepsek mt-5 pt-5">
        <div class="container">
            <img src="{{ asset('guest/images/darimun.jpeg') }}" alt="Kepala SMK N 2 Purbalingga">

            <div class="visiMisi">
                <div class="visi">
                    <h5>Kata Sambutan</h5>
                    <h3>Nurturing Leaders for God, Country and Community</h3>
                </div>
            </div>
        </div>
    </div>
@endsection