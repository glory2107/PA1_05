<?php   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function visimisi()
    {
        $profils = ProfilSekolah::latest()->get();
        return view('guest.visimisi', compact('profils'));
    }

    public function sejarahsingkat()
    {
        return view('guest.sejarahsingkat');
    }

    public function katasambutan()
    {
        return view('guest.katasambutan');
    }

    public function fasilitassekolah()
    {
        $fasilitas = FasilitasSekolah::latest()->get();
        return view('guest.fasilitassekolah', compact('fasilitas'));
    }

    public function galeri()
    {
        $galeri = \App\Models\Galeri::latest()->get(); // Ambil semua data galeri
        return view('guest.galeri', compact('galeri'));
    }

    public function galeriDetail($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('guest.galeri-detail', compact('galeri'));
    }

    public function tenagakerja()
    {
        $tenagaKerja = TenagaKerja::latest()->get();
        return view('guest.tenagakerja', compact('tenagaKerja'));
    }

    public function prestasi()
    {
        $prestasi = Prestasi::latest()->get();
        return view('guest.prestasi', compact('prestasi'));
    }

    public function prestasiDetail($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('guest.prestasi-detail', compact('prestasi'));
    }

    public function alumni()
    {
        $alumni = Alumni::latest()->get();
        return view('guest.alumni', compact('alumni'));
    }

    public function alumniDetail($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('guest.alumni-detail', compact('alumni'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('status', 'aktif')->latest()->get();
        return view('guest.pengumuman', compact('pengumuman'));
    }

    public function pengumumanDetail($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('guest.pengumuman-detail', compact('pengumuman'));
    }

    public function event()
    {
        $events = Event::latest()->get();
        return view('guest.event', compact('events'));
    }

    public function eventDetail($id)
    {
        $event = Event::findOrFail($id); // Ambil data event berdasarkan ID
        return view('guest.event-detail', compact('event')); // Kirim ke view detail
    }

    public function jadwal()
    {
        return view('guest.jadwal');
    }

    public function ekstrakurikuler()
    {
        $ekstrakurikuler = Ekstrakurikuler::latest()->get(); // ✅ tambahkan baris ini
        return view('guest.ekstrakurikuler', compact('ekstrakurikuler'));
    }

    public function ekstrakurikulerDetail($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('guest.ekstrakurikuler-detail', compact('ekstrakurikuler'));
    }

    public function kontak()
    {
        $kontaks = Kontak::where('status', 'aktif')->latest()->get();
        return view('guest.kontak', compact('kontaks'));
    }
}
