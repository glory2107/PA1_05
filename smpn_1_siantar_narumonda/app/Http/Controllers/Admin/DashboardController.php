<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use App\Models\FasilitasSekolah;
use App\Models\TenagaKerja;
use App\Models\Prestasi;
use App\Models\Alumni;
use App\Models\Pengumuman;
use App\Models\Event;
use App\Models\Kontak;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\StrukturOrganisasi;
use App\Models\SejarahSekolah;
use App\Models\KataSambutan;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data dari masing-masing model
        $profilSekolahCount = ProfilSekolah::count();
        $fasilitasSekolahCount = FasilitasSekolah::count();
        $tenagaKerjaCount = TenagaKerja::count();
        $prestasiCount = Prestasi::count();
        $alumniCount = Alumni::count();
        $pengumumanCount = Pengumuman::count();
        $eventCount = Event::count();
        $kontakCount = Kontak::count();
        $ekstrakurikulerCount = Ekstrakurikuler::count();
        $galeriCount = Galeri::count();
        $strukturOrganisasiCount = StrukturOrganisasi::count();
        $sejarahSekolahCount = SejarahSekolah::count();
        $kataSambutanCount = KataSambutan::count();

        // Mengirimkan data jumlah ke view
        return view('admin.dashboard', compact(
            'profilSekolahCount', 'fasilitasSekolahCount', 'tenagaKerjaCount', 'prestasiCount',
            'alumniCount', 'pengumumanCount', 'eventCount', 'kontakCount', 'ekstrakurikulerCount',
            'galeriCount', 'strukturOrganisasiCount', 'sejarahSekolahCount', 'kataSambutanCount'
        ));
    }
}
