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
use App\Models\StrukturOrganisasi;
use App\Models\SejarahSekolah;
use App\Models\KataSambutan;
use App\Models\Slider; // Tambahkan import model Slider

class GuestController extends Controller
{
    public function index()
    {
        $fasilitas = FasilitasSekolah::latest()->take(3)->get();
        $prestasi = Prestasi::latest()->take(3)->get();
        $alumni = Alumni::latest()->take(6)->get();
        $profils = ProfilSekolah::latest()->take(1)->get();
        $ekstrakurikuler = Ekstrakurikuler::latest()->take(4)->get();

        $sliders = Slider::all(); // Ambil semua data slider

        // Kirim data slider bersama data lainnya ke view
        return view('guest.index', compact('fasilitas', 'prestasi', 'alumni', 'profils', 'sliders', 'ekstrakurikuler'));
    }

    public function visimisi()
    {
        $profils = ProfilSekolah::latest()->get();
        return view('guest.visimisi', compact('profils'));
    }

    public function sejarah_sekolah()
    {
        $sejarahSekolahs = SejarahSekolah::latest()->get();
        return view('guest.sejarah_sekolah', compact('sejarahSekolahs'));
    }

    public function katasambutan()
    {
        $kataSambutans = KataSambutan::latest()->get();
        return view('guest.katasambutan', compact('kataSambutans'));
    }

    public function fasilitassekolah()
    {
        $fasilitas = FasilitasSekolah::latest()->get();
        return view('guest.fasilitassekolah', compact('fasilitas'));
    }

    public function fasilitassekolahDetail($id)
    {
        $fasilitas = FasilitasSekolah::findOrFail($id);
        return view('guest.fasilitassekolah-detail', compact('fasilitas'));
    }

    public function galeri()
    {
        $galeri = Galeri::latest()->get();
        return view('guest.galeri', compact('galeri'));
    }

    public function galeriDetail($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('guest.galeri-detail', compact('galeri'));
    }

    public function strukturorganisasi()
    {
        $strukturorganisasi = StrukturOrganisasi::latest()->get();
        return view('guest.strukturorganisasi', compact('strukturorganisasi'));
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

    // Method pengumuman dengan pagination dan search
    public function pengumuman(Request $request)
    {
        $search = $request->input('search');

        $query = Pengumuman::where('status', 'aktif');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $pengumuman = $query->orderBy('tanggal', 'desc')->paginate(6);

        // Menyertakan query 'search' pada pagination link
        $pengumuman->appends(['search' => $search]);

        return view('guest.pengumuman', compact('pengumuman', 'search'));
    }

    public function pengumumanDetail($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('guest.pengumuman-detail', compact('pengumuman'));
    }

    public function event(Request $request)
    {
        $search = $request->input('search');

        $query = Event::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Ubah urutan menjadi acak
        $events = $query->orderBy('created_at', 'asc')->paginate(5);

        // Sertakan query 'search' pada pagination link
        $events->appends(['search' => $search]);

        return view('guest.event', compact('events', 'search'));
    }


    public function eventDetail($id)
    {
        $event = Event::findOrFail($id);
        return view('guest.event-detail', compact('event'));
    }

    public function jadwal()
    {
        return view('guest.jadwal');
    }

    public function ekstrakurikuler()
    {
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
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
