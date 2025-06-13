<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    // Menampilkan daftar prestasi
    public function index()
    {
        // Mengambil semua data prestasi
        $prestasi = Prestasi::latest()->get();

        // Mengirimkan data prestasi ke view
        return view('admin.prestasi.index', compact('prestasi'));
    }

    // Menampilkan form untuk menambah prestasi
    public function create()
    {
        return view('admin.prestasi.create');
    }

    // Menyimpan prestasi baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal'     => 'required|date',
        ]);

        // Menyimpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('prestasi', 'public');
        }

        // Menyimpan data prestasi
        Prestasi::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'tanggal'      => $request->tanggal,
            'created_by'   => Auth::id(),
        ]);

        // Redirect setelah sukses
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit prestasi
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    // Memperbarui data prestasi
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Validasi input
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal'     => 'required|date',
        ]);

        // Menyimpan gambar baru jika ada
        $imagePath = $prestasi->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('prestasi', 'public');
        }

        // Update data prestasi
        $prestasi->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'tanggal'      => $request->tanggal,
            'modified_by'  => Auth::id(),
        ]);

        // Redirect setelah sukses
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    // Menghapus prestasi
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Hapus gambar jika ada
        if ($prestasi->image && Storage::disk('public')->exists($prestasi->image)) {
            Storage::disk('public')->delete($prestasi->image);
        }

        // Hapus data prestasi
        $prestasi->delete();

        // Redirect setelah sukses
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
