<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FasilitasSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FasilitasSekolahController extends Controller
{
    // Menampilkan daftar fasilitas sekolah
    public function index()
    {
        $fasilitas = FasilitasSekolah::latest()->get();  // Mengambil semua data fasilitas
        return view('admin.fasilitas-sekolah.index', compact('fasilitas'));  // Mengirim data ke view
    }

    // Menampilkan form untuk membuat fasilitas sekolah baru
    public function create()
    {
        return view('admin.fasilitas-sekolah.create');  // Menampilkan form tambah fasilitas
    }

    // Menyimpan fasilitas sekolah baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Menyimpan gambar fasilitas sekolah
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fasilitas-sekolah', 'public');
        }

        // Menyimpan data fasilitas sekolah ke database
        FasilitasSekolah::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'created_by'   => Auth::id(),
        ]);

        // Redirect setelah menyimpan data
        return redirect()->route('admin.fasilitas-sekolah.index')->with('success', 'Fasilitas sekolah berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit fasilitas sekolah
    public function edit($id)
    {
        $fasilitas = FasilitasSekolah::findOrFail($id);  // Mengambil data fasilitas berdasarkan ID
        return view('admin.fasilitas-sekolah.edit', compact('fasilitas'));  // Menampilkan form edit
    }

    // Mengupdate fasilitas sekolah yang ada
    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasSekolah::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mengambil gambar yang ada jika ada
        $imagePath = $fasilitas->image;
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('fasilitas-sekolah', 'public');
        }

        // Update data fasilitas sekolah
        $fasilitas->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.fasilitas-sekolah.index')->with('success', 'Fasilitas sekolah berhasil diperbarui.');
    }

    // Menghapus fasilitas sekolah
    public function destroy($id)
    {
        $fasilitas = FasilitasSekolah::findOrFail($id);

        // Menghapus gambar yang ada jika ada
        if ($fasilitas->image && Storage::disk('public')->exists($fasilitas->image)) {
            Storage::disk('public')->delete($fasilitas->image);
        }

        // Menghapus data fasilitas sekolah
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas-sekolah.index')->with('success', 'Fasilitas sekolah berhasil dihapus.');
    }
}
