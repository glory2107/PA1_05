<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TenagaKerjaController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\GaleriController;  // Tambahkan GaleriController di sini
use App\Http\Controllers\Admin\FasilitasSekolahController;  // Tambahkan FasilitasSekolahController


// ----------------------------
// Route untuk halaman publik
// ----------------------------
Route::get('/', [GuestController::class, 'index']);  // Menambahkan GuestController di sini
Route::get('/visimisi', [GuestController::class, 'visimisi']);
Route::get('/sejarahsingkat', [GuestController::class, 'sejarahsingkat']);
Route::get('/katasambutan', [GuestController::class, 'katasambutan']);
Route::get('/fasilitassekolah', [GuestController::class, 'fasilitassekolah']);
Route::get('/galeri', [GuestController::class, 'galeri']);
Route::get('/galeri/{id}', [GuestController::class, 'galeriDetail'])->name('guest.galeri.detail');
Route::get('/tenagakerja', [GuestController::class, 'tenagakerja']);
Route::get('/prestasi', [GuestController::class, 'prestasi']);
Route::get('/alumni', [GuestController::class, 'alumni']);
Route::get('/alumni/{id}', [GuestController::class, 'alumniDetail'])->name('guest.alumni.detail');
Route::get('/prestasi/{id}', [GuestController::class, 'prestasiDetail'])->name('guest.prestasi.detail');
Route::get('/pengumuman', [GuestController::class, 'pengumuman']);
Route::get('/pengumuman/{id}', [GuestController::class, 'pengumumanDetail'])->name('guest.pengumuman.detail');
Route::get('/event', [GuestController::class, 'event']);
Route::get('/event/{id}', [GuestController::class, 'eventDetail'])->name('guest.event.detail');
Route::get('/ekstrakurikuler', [GuestController::class, 'ekstrakurikuler']);
Route::get('/ekstrakurikuler/{id}', [GuestController::class, 'ekstrakurikulerDetail'])->name('guest.ekstrakurikuler.detail');
Route::get('/kontak', [GuestController::class, 'kontak']);

// ----------------------------
// Route untuk login admin
// ----------------------------
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// ----------------------------
// Route untuk admin (dengan autentikasi)
// ----------------------------
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen profil sekolah
    Route::resource('profil-sekolah', ProfilSekolahController::class);

    // Manajemen pengumuman
    Route::resource('pengumuman', PengumumanController::class);

    // Manajemen ekstrakurikuler
    Route::resource('ekstrakurikuler', EkstrakurikulerController::class);

    // Manajemen kontak
    Route::resource('kontak', KontakController::class);

    // Manajemen event
    Route::resource('event', EventController::class);

    // Manajemen tenaga kerja
    Route::resource('tenaga-kerja', TenagaKerjaController::class);

    // Manajemen prestasi
    Route::resource('prestasi', PrestasiController::class);  // Tambahkan route resource untuk Prestasi

    // Manajemen alumni
    Route::resource('alumni', AlumniController::class);
    
    // Manajemen galeri
    Route::resource('galeri', GaleriController::class);  // Tambahkan route resource untuk Galeri
    
    // Manajemen fasilitas sekolah
    Route::resource('fasilitas-sekolah', FasilitasSekolahController::class);  // Tambahkan route resource untuk Fasilitas Sekolah
});
