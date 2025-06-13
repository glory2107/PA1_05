@extends('layouts.admin.app') 

@section('title', 'Dashboard')

@section('content')
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Dashboard
  </h2>

  <!-- Dashboard stats grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    <!-- Profil Sekolah -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-school text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Visi Misi</div>
        <div class="text-3xl text-blue-500">{{ $profilSekolahCount }}</div>
        <div class="text-sm text-gray-500">Total records in Visi Misi</div>
      </div>
    </div>

    <!-- Kata Sambutan -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-comments text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Kata Sambutan</div>
        <div class="text-3xl text-blue-500">{{ $kataSambutanCount }}</div>
        <div class="text-sm text-gray-500">Total records in Kata Sambutan</div>
      </div>
    </div>

    <!-- Sejarah Sekolah -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-history text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Sejarah Sekolah</div>
        <div class="text-3xl text-blue-500">{{ $sejarahSekolahCount }}</div>
        <div class="text-sm text-gray-500">Total records in Sejarah Sekolah</div>
      </div>
    </div>

    <!-- Fasilitas Sekolah -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-cogs text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Fasilitas Sekolah</div>
        <div class="text-3xl text-blue-500">{{ $fasilitasSekolahCount }}</div>
        <div class="text-sm text-gray-500">Total records in Fasilitas Sekolah</div>
      </div>
    </div>

    <!-- Tenaga Kerja -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-users text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Tenaga Kerja</div>
        <div class="text-3xl text-blue-500">{{ $tenagaKerjaCount }}</div>
        <div class="text-sm text-gray-500">Total records in Tenaga Kerja</div>
      </div>
    </div>

    <!-- Prestasi -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-trophy text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Prestasi</div>
        <div class="text-3xl text-blue-500">{{ $prestasiCount }}</div>
        <div class="text-sm text-gray-500">Total records in Prestasi</div>
      </div>
    </div>

    <!-- Alumni -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-user-graduate text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Alumni</div>
        <div class="text-3xl text-blue-500">{{ $alumniCount }}</div>
        <div class="text-sm text-gray-500">Total records in Alumni</div>
      </div>
    </div>

    <!-- Pengumuman -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-bullhorn text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Pengumuman</div>
        <div class="text-3xl text-blue-500">{{ $pengumumanCount }}</div>
        <div class="text-sm text-gray-500">Total records in Pengumuman</div>
      </div>
    </div>

    <!-- Event -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-calendar-alt text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Event</div>
        <div class="text-3xl text-blue-500">{{ $eventCount }}</div>
        <div class="text-sm text-gray-500">Total records in Event</div>
      </div>
    </div>

    <!-- Kontak -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-phone text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Kontak</div>
        <div class="text-3xl text-blue-500">{{ $kontakCount }}</div>
        <div class="text-sm text-gray-500">Total records in Kontak</div>
      </div>
    </div>

    <!-- Ekstrakurikuler -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-chalkboard-teacher text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Ekstrakurikuler</div>
        <div class="text-3xl text-blue-500">{{ $ekstrakurikulerCount }}</div>
        <div class="text-sm text-gray-500">Total records in Ekstrakurikuler</div>
      </div>
    </div>

    <!-- Galeri -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-images text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Galeri</div>
        <div class="text-3xl text-blue-500">{{ $galeriCount }}</div>
        <div class="text-sm text-gray-500">Total records in Galeri</div>
      </div>
    </div>

    <!-- Struktur Organisasi -->
    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
      <i class="fas fa-sitemap text-3xl text-blue-500"></i>
      <div>
        <div class="text-lg font-semibold text-gray-700">Struktur Organisasi</div>
        <div class="text-3xl text-blue-500">{{ $strukturOrganisasiCount }}</div>
        <div class="text-sm text-gray-500">Total records in Struktur Organisasi</div>
      </div>
    </div>
  </div>
@endsection
