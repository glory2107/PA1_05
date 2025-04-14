<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    <title>@yield('title')</title>

    {{-- Shortcut Icon --}}
    <link rel="shortcut icon" href="{{ asset('guest/images/logo.png') }}" type="image/x-icon">

    {{-- Style CSS Lokal --}}
    <link rel="stylesheet" href="{{ asset('guest/css/style.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Bootstrap 4.6 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">

    {{-- LightSlider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    {{-- Navbar (jika ada file navbar.blade.php) --}}
    @include('layouts.guest.navbar')

    {{-- Konten Dinamis --}}
    <div class="container-fluid px-0">
        @yield('content')
    </div>

    {{-- Footer Global --}}
    @include('layouts.guest.footer')

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

    {{-- Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    {{-- LightSlider --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- JS Lokal --}}
    <script src="{{ asset('guest/js/script.js') }}"></script>
</body>
</html>
