<nav class="navbar navbar-expand-lg navbar-light navbarHome fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('guest/images/logo.png') }}" alt="Logo SMK N 2 Purbalingga">
            <h1>SMK Negeri 2<br>Purbalingga</h1>
        </a>

        <button class="navbar-toggler hamburger" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="{{ url('visimisi') }}">Informasi Umum</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('fasilitassekolah') }}">Fasilitas Sekolah</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('galeri') }}">Galeri</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('tenagakerja') }}">Tenaga Kerja</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('alumni') }}">Alumni</a>
                    </div>
                </li>

                <li class="nav-item active"><a class="nav-link" href="{{ url('prestasi') }}">Prestasi</a></li>
                <li class="nav-item active"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                <li class="nav-item active"><a class="nav-link" href="{{ url('event') }}">Event</a></li>
                <li class="nav-item active"><a class="nav-link" href="{{ url('ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                <li class="nav-item active"><a class="nav-link" href="{{ url('kontak') }}">Kontak</a></li>
                <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
