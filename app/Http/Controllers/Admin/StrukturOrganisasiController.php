<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
        // Menampilkan daftar Struktur Organisasi
        public function index()
        {
            // Mengambil semua data StrukturOrganisasi dengan urutan terbaru
            $strukturs = StrukturOrganisasi::latest()->get();

            return view('admin.struktur_organisasi.index', compact('strukturs'));
        }

        // Menampilkan form untuk membuat Struktur Organisasi baru
        public function create()
        {
            return view('admin.struktur_organisasi.create');
        }

        // Menyimpan Struktur Organisasi baru
        public function store(Request $request)
        {
        // Validasi hanya untuk image
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Menyimpan path gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('struktur_organisasi', 'public');
        }

        // Membuat data StrukturOrganisasi baru dengan created_by dan modified_by otomatis terisi menggunakan Auth::id()
        StrukturOrganisasi::create([
            'image'        => $imagePath,
            'created_by'   => Auth::id(), 
            'modified_by'  => Auth::id(),   
        ]);

        // Redirect ke halaman daftar Struktur Organisasi
            return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
        }

        // Menampilkan form untuk mengedit Struktur Organisasi
        public function edit($id)
        {
            // Mencari data Struktur Organisasi berdasarkan ID
            $struktur = StrukturOrganisasi::findOrFail($id);
            return view('admin.struktur_organisasi.edit', compact('struktur'));
        }

        // Mengupdate Struktur Organisasi berdasarkan ID
        public function update(Request $request, $id)
        {
        // Mencari data Struktur Organisasi berdasarkan ID
        $struktur = StrukturOrganisasi::findOrFail($id);

        // Validasi hanya untuk image
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mendapatkan path gambar lama
        $imagePath = $struktur->image;

        // Hapus gambar lama jika user memilih untuk menghapus gambar
        if ($request->has('delete_image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null;
        }

        // Ganti dengan gambar baru jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('struktur_organisasi', 'public');
        }

        // Update data Struktur Organisasi
        $struktur->update([
            'image'        => $imagePath,
            'created_by'   => $struktur->created_by,  // Tidak perlu diubah, tetap menggunakan nilai lama
            'modified_by'  => Auth::id(),              // Hanya diubah ke ID user yang sedang login
        ]);

        // Redirect ke halaman daftar Struktur Organisasi
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
        }

        // Menghapus Struktur Organisasi berdasarkan ID
        public function destroy($id)
        {
        // Mencari data Struktur Organisasi berdasarkan ID
        $struktur = StrukturOrganisasi::findOrFail($id);

        // Hapus gambar jika ada
        if ($struktur->image && Storage::disk('public')->exists($struktur->image)) {
            Storage::disk('public')->delete($struktur->image);
        }

        // Menghapus data Struktur Organisasi
        $struktur->delete();

        // Redirect ke halaman daftar Struktur Organisasi
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
