<nav class="navbar navbar-expand-lg navbar-light navbarHome fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('guest/images/Logoku.jpg') }}" alt="Logo smp negeri 1 siantar narumonda">
            <h1>SMP Negeri 1<br>Siantar Narumonda</h1>
        </a>

        <button class="navbar-toggler hamburger" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item dropdown {{ request()->is('visimisi', 'katasambutan', 'sejarah_sekolah', 'fasilitassekolah', 'strukturorganisasi') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" id="profilDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profilDropdown">
                        <a class="dropdown-item {{ request()->is('visimisi') ? 'active' : '' }}" href="{{ url('visimisi') }}">Visi & Misi</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('katasambutan') ? 'active' : '' }}" href="{{ url('katasambutan') }}">Kata Sambutan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('sejarah_sekolah') ? 'active' : '' }}" href="{{ url('sejarah_sekolah') }}">Sejarah Sekolah</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('fasilitassekolah') ? 'active' : '' }}" href="{{ url('fasilitassekolah') }}">Fasilitas Sekolah</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('strukturorganisasi') ? 'active' : '' }}" href="{{ url('strukturorganisasi') }}">Struktur Organisasi</a>
                    </div>
                </li>

                <li class="nav-item dropdown {{ request()->is('event', 'pengumuman', 'ekstrakurikuler', 'alumni') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" id="infoDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Informasi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="infoDropdown">
                        <a class="dropdown-item {{ request()->is('event') ? 'active' : '' }}" href="{{ url('event') }}">Berita</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('pengumuman') ? 'active' : '' }}" href="{{ url('pengumuman') }}">Pengumuman</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('ekstrakurikuler') ? 'active' : '' }}" href="{{ url('ekstrakurikuler') }}">Ekstrakurikuler</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->is('alumni') ? 'active' : '' }}" href="{{ url('alumni') }}">Alumni</a>
                    </div>
                </li>

                <li class="nav-item {{ request()->is('tenagakerja') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('tenagakerja') }}">Tenaga Kerja</a>
                </li>
                <li class="nav-item {{ request()->is('prestasi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('prestasi') }}">Prestasi</a>
                </li>
                <li class="nav-item {{ request()->is('galeri') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('galeri') }}">Galeri</a>
                </li>
                <li class="nav-item {{ request()->is('kontak') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('kontak') }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    
    .navbar-nav .nav-link {
        color: #000; 
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-item.active > .nav-link {
        color: #007bff; 
    }

    
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-item.active > .nav-link {
        background-color: transparent !important;
        color: #007bff !important;
    }

    
    .dropdown-item:hover,
    .dropdown-item:focus,
    .dropdown-item:active {
        background-color: transparent !important;
        color: #007bff !important;
    }

    .dropdown-item.active {
        font-weight: 600;
        background-color: transparent !important;
        color: #007bff !important;
    }
</style>
