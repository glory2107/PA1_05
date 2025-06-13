<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SejarahSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SejarahSekolahController extends Controller
{
    // Menampilkan daftar Sejarah Sekolah
    public function index()
    {
        // Mengambil semua data Sejarah Sekolah
        $sejarahSekolahs = SejarahSekolah::latest()->get();

        // Menampilkan view dengan data sejarah sekolah
        return view('admin.sejarah_sekolah.index', compact('sejarahSekolahs'));
    }

    // Menampilkan form untuk membuat Sejarah Sekolah baru
    public function create()
    {
        return view('admin.sejarah_sekolah.create');
    }

    // Menyimpan Sejarah Sekolah baru
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Menyimpan path gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sejarah_sekolah', 'public');
        }

        // Membuat data Sejarah Sekolah baru
        SejarahSekolah::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'created_by'   => Auth::id(),  // Menggunakan ID admin yang sedang login
            'modified_by'  => Auth::id(),  // Menggunakan ID admin yang sedang login
        ]);

        // Redirect ke halaman daftar Sejarah Sekolah
        return redirect()->route('admin.sejarah-sekolah.index')->with('success', 'Sejarah Sekolah berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit Sejarah Sekolah
    public function edit($id)
    {
        // Mencari data Sejarah Sekolah berdasarkan ID
        $sejarahSekolah = SejarahSekolah::findOrFail($id);
        
        // Menampilkan view untuk edit dengan data Sejarah Sekolah
        return view('admin.sejarah_sekolah.edit', compact('sejarahSekolah'));
    }

    // Mengupdate Sejarah Sekolah berdasarkan ID
    public function update(Request $request, $id)
    {
        // Mencari data Sejarah Sekolah berdasarkan ID
        $sejarahSekolah = SejarahSekolah::findOrFail($id);

        // Validasi input data
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mendapatkan path gambar lama
        $imagePath = $sejarahSekolah->image;

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
            $imagePath = $request->file('image')->store('sejarah_sekolah', 'public');
        }

        // Update data Sejarah Sekolah
        $sejarahSekolah->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'modified_by'  => Auth::id(),  // Menggunakan ID admin yang sedang login
        ]);

        // Redirect ke halaman daftar Sejarah Sekolah
        return redirect()->route('admin.sejarah-sekolah.index')->with('success', 'Sejarah Sekolah berhasil diperbarui.');
    }

    // Menghapus Sejarah Sekolah berdasarkan ID
    public function destroy($id)
    {
        // Mencari data Sejarah Sekolah berdasarkan ID
        $sejarahSekolah = SejarahSekolah::findOrFail($id);

        // Hapus gambar jika ada
        if ($sejarahSekolah->image && Storage::disk('public')->exists($sejarahSekolah->image)) {
            Storage::disk('public')->delete($sejarahSekolah->image);
        }

        // Menghapus data Sejarah Sekolah
        $sejarahSekolah->delete();

        // Redirect ke halaman daftar Sejarah Sekolah
        return redirect()->route('admin.sejarah-sekolah.index')->with('success', 'Sejarah Sekolah berhasil dihapus.');
    }
}
