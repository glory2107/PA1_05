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
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\FasilitasSekolahController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\KataSambutanController;
use App\Http\Controllers\Admin\SejarahSekolahController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;

// ----------------------------
// Route untuk halaman publik
// ----------------------------
Route::get('/', [GuestController::class, 'index']);
Route::get('/visimisi', [GuestController::class, 'visimisi']);
Route::get('/sejarah_sekolah', [GuestController::class, 'sejarah_sekolah']);
Route::get('/katasambutan', [GuestController::class, 'katasambutan']);
Route::get('/strukturorganisasi', [GuestController::class, 'strukturorganisasi']);
Route::get('/fasilitassekolah', [GuestController::class, 'fasilitassekolah'])->name('guest.fasilitassekolah');
Route::get('/fasilitassekolah/{id}', [GuestController::class, 'fasilitassekolahDetail'])->name('guest.fasilitassekolah.detail');
Route::get('/galeri', [GuestController::class, 'galeri']);
Route::get('/galeri/{id}', [GuestController::class, 'galeriDetail'])->name('guest.galeri.detail');
Route::get('/tenagakerja', [GuestController::class, 'tenagakerja']);
Route::get('/prestasi', [GuestController::class, 'prestasi'])->name('guest.prestasi');
Route::get('/alumni', [GuestController::class, 'alumni'])->name('guest.alumni');
Route::get('/alumni/{id}', [GuestController::class, 'alumniDetail'])->name('guest.alumni.detail');
Route::get('/prestasi/{id}', [GuestController::class, 'prestasiDetail'])->name('guest.prestasi.detail');
Route::get('/pengumuman', [GuestController::class, 'pengumuman'])->name('guest.pengumuman');
Route::get('/pengumuman/{id}', [GuestController::class, 'pengumumanDetail'])->name('guest.pengumuman.detail');
Route::get('/event', [GuestController::class, 'event'])->name('guest.event');
Route::get('/event/{id}', [GuestController::class, 'eventDetail'])->name('guest.event.detail');
Route::get('/ekstrakurikuler', [GuestController::class, 'ekstrakurikuler'])->name('guest.ekstrakurikuler');
Route::get('/ekstrakurikuler/{id}', [GuestController::class, 'ekstrakurikulerDetail'])->name('guest.ekstrakurikuler.detail');
Route::get('/kontak', [GuestController::class, 'kontak']);

// ----------------------------
// Route untuk login admin dan LUPA PASSWORD ADMIN (TIDAK BERGANTUNG PADA AUTH)
// ----------------------------
Route::prefix('admin')->name('admin.')->group(function () {
    // Route login admin - tidak perlu middleware karena untuk login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    
    // Route logout - perlu middleware admin untuk memastikan user sudah login
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('admin');

    // Route untuk LUPA PASSWORD ADMIN - tidak perlu middleware
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// ----------------------------
// Route untuk admin (dengan autentikasi)
// Menggunakan middleware 'admin' yang sudah kita buat
// ----------------------------
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen profil sekolah
    Route::resource('profil-sekolah', ProfilSekolahController::class);

    // Manajemen Kata Sambutan (resource)
    Route::resource('kata-sambutan', KataSambutanController::class);

    // Manajemen Sejarah Sekolah (resource)
    Route::resource('sejarah-sekolah', SejarahSekolahController::class);

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
    Route::resource('prestasi', PrestasiController::class);

    // Manajemen alumni
    Route::resource('alumni', AlumniController::class);

    // Manajemen galeri
    Route::resource('galeri', GaleriController::class);

    // Manajemen slider
    Route::resource('slider', SliderController::class);

    // Manajemen fasilitas sekolah
    Route::resource('fasilitas-sekolah', FasilitasSekolahController::class);

    // Manajemen Struktur Organisasi
    Route::resource('struktur-organisasi', StrukturOrganisasiController::class);
});