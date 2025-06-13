<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
  <div class="py-4 text-gray-500 dark:text-gray-400">
    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ route('admin.dashboard') }}">
      Admin - Panel     
    </a>
    
    <ul class="mt-6">
      {{-- Dashboard --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/dashboard'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.dashboard') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/dashboard') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span class="ml-4">Dashboard</span>
        </a>
      </li>

      <!-- Visi & Misi -->
<li class="relative px-6 py-3">
  <a href="{{ route('admin.profil-sekolah.index') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/profil-sekolah.index') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Visi & Misi (Bohlam) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M9 18c0 1.104.896 2 2 2s2-.896 2-2H9zM12 2C7.029 2 3 6.029 3 10c0 2.742 2.097 5.101 4.793 6.707C8.482 18.132 9 19 9 20h6c0-1 .518-1.868 1.207-3.293C18.903 15.101 21 12.742 21 10c0-3.971-4.029-8-9-8zM12 15h-1v-4h1v4z"/>
    </svg>
    <span class="ml-4">Visi & Misi</span>
  </a>
</li>


   <!-- Kata Sambutan -->
<li class="relative px-6 py-3">
  <a href="{{ route('admin.kata-sambutan.index') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/kata-sambutan.index') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Kata Sambutan (Megafon) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M14 2v6h4v4h-4v6l-6-6h-4v-4h4l6-6z" />
    </svg>
    <span class="ml-4">Kata Sambutan</span>
  </a>
</li>

<!-- Sejarah Sekolah -->
<li class="relative px-6 py-3">
  <a href="{{ route('admin.sejarah-sekolah.index') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/sejarah-sekolah.index') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Sejarah Sekolah (Buku dengan Pena) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M6 3v18h12V3H6zm2 2h8v14H8V5z" />
      <path d="M10 9l1 4 4-1 1 1-4 1-1 4-1-4-4-1z" />
    </svg>
    <span class="ml-4">Sejarah Sekolah</span>
  </a>
</li>



      {{-- Tenaga Kerja --}}
<li class="relative px-6 py-3">
  @if (Request::is('admin/tenaga-kerja*'))
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a href="{{ route('admin.tenaga-kerja.index') }}"
    class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/tenaga-kerja*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Tenaga Kerja (Beberapa Orang) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
    </svg>
    <span class="ml-4">Tenaga Kerja</span>
  </a>
</li>


      {{-- Prestasi --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/prestasi*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.prestasi.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/prestasi*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2l2.92 6.14 6.77-.55-5.03 4.86L17.6 21 12 17.4 6.4 21l.94-7.09-5.03-4.86 6.77.55L12 2z" />
          </svg>
          <span class="ml-4">Prestasi</span>
        </a>
      </li>

   <!-- Alumni --> 
<li class="relative px-6 py-3">
  <a href="{{ route('admin.alumni.index') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/alumni*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Alumni (Topi Wisuda) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M3 6l9-3 9 3-9 3-9-3z" />
      <path d="M4 9l8 3 8-3" />
      <path d="M10 12v4h4v-4" />
    </svg>
    <span class="ml-4">Alumni</span>
  </a>
</li>


      {{-- Galeri --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/galeri*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.galeri.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/galeri*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4v16h16V4H4zm2 2h12v12H6V6z" />
          </svg>
          <span class="ml-4">Galeri</span>
        </a>
      </li>

      {{-- Slider --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/slider*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.slider.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
          {{ Request::is('admin/slider*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <span class="ml-4">Slider</span>
        </a>
      </li>

      {{-- Fasilitas Sekolah --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/fasilitas-sekolah*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.fasilitas-sekolah.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/fasilitas-sekolah*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 9V5a2 2 0 00-2-2H6a2 2 0 00-2 2v4M3 19v-6h18v6" />
          </svg>
          <span class="ml-4">Fasilitas Sekolah</span>
        </a>
      </li>

      {{-- Struktur Organisasi --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/struktur-organisasi*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.struktur-organisasi.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/struktur-organisasi*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2l4 4-4 4-4-4 4-4z" />
            <path d="M12 12l4 4-4 4-4-4 4-4z" />
            <path d="M12 22l4 4-4 4-4-4 4-4z" />
          </svg>
          <span class="ml-4">Struktur Organisasi</span>
        </a>
      </li>

      {{-- Pengumuman --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/pengumuman*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.pengumuman.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/pengumuman*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 11H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2zM5 11V9a2 2 0 012-2m12 4V9a2 2 0 00-2-2M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/>
          </svg>
          <span class="ml-4">Pengumuman</span>
        </a>
      </li>

      {{-- Ekstrakurikuler --}}
      <li class="relative px-6 py-3">
        @if (Request::is('admin/ekstrakurikuler*'))
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
        @endif
        <a href="{{ route('admin.ekstrakurikuler.index') }}"
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
          {{ Request::is('admin/ekstrakurikuler*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
          hover:text-gray-800 dark:hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 12L2 2m2 0l8 8m-8 0l8 8M12 12l8-8m-8 8l8 8" />
          </svg>
          <span class="ml-4">Ekstrakurikuler</span>
        </a>
      </li>

     {{-- Berita --}}
<li class="relative px-6 py-3">
  @if (Request::is('admin/event*'))
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a href="{{ route('admin.event.index') }}"
    class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/event*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Berita (Pesawat Kertas) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M2 12l18-7-5 7 5 7-18-7 5-7z" />
    </svg>
    <span class="ml-4">Berita</span>
  </a>
</li>


  {{-- Kontak --}}
<li class="relative px-6 py-3">
  @if (Request::is('admin/kontak*'))
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a href="{{ route('admin.kontak.index') }}"
    class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
    {{ Request::is('admin/kontak*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
    hover:text-gray-800 dark:hover:text-gray-200">
    <!-- Ikon Kontak (Telepon) -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 16.6c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V7.4c0-1.1.9-2 2-2h16c1.1 0 2 .9 2 2v9.2z" />
      <path d="M6 10l-1.5 2.1L8 14l1.5-2.9L6 10z" />
    </svg>
    <span class="ml-4">Kontak</span>
  </a>
</li>

    </ul>
  </div>
</aside>
