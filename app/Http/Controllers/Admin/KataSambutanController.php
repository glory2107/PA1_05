<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KataSambutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KataSambutanController extends Controller
{
    // Menampilkan daftar Kata Sambutan
    public function index()
    {
        // Mengambil semua data Kata Sambutan
        $kataSambutans = KataSambutan::latest()->get();

        // Menampilkan view dengan data kata sambutan
        return view('admin.kata_sambutan.index', compact('kataSambutans'));
    }

    // Menampilkan form untuk membuat Kata Sambutan baru
    public function create()
    {
        return view('admin.kata_sambutan.create');
    }

    // Menyimpan Kata Sambutan baru
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
            $imagePath = $request->file('image')->store('kata_sambutan', 'public');
        }

        // Membuat data Kata Sambutan baru
        KataSambutan::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'created_by'   => Auth::id(),  
            'modified_by'  => Auth::id(),  
        ]);

        // Redirect ke halaman daftar Kata Sambutan
        return redirect()->route('admin.kata-sambutan.index')->with('success', 'Kata Sambutan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit Kata Sambutan
    public function edit($id)
    {
        // Mencari data Kata Sambutan berdasarkan ID
        $kataSambutan = KataSambutan::findOrFail($id);
        
        // Menampilkan view untuk edit dengan data kata sambutan
        return view('admin.kata_sambutan.edit', compact('kataSambutan'));
    }

    // Mengupdate Kata Sambutan berdasarkan ID
    public function update(Request $request, $id)
    {
        // Mencari data Kata Sambutan berdasarkan ID
        $kataSambutan = KataSambutan::findOrFail($id);

        // Validasi input data
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mendapatkan path gambar lama
        $imagePath = $kataSambutan->image;

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
            $imagePath = $request->file('image')->store('kata_sambutan', 'public');
        }

        // Update data Kata Sambutan
        $kataSambutan->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'modified_by'  => Auth::id(), 
        ]);

        // Redirect ke halaman daftar Kata Sambutan
        return redirect()->route('admin.kata-sambutan.index')->with('success', 'Kata Sambutan berhasil diperbarui.');
    }

    // Menghapus Kata Sambutan berdasarkan ID
    public function destroy($id)
    {
        // Mencari data Kata Sambutan berdasarkan ID
        $kataSambutan = KataSambutan::findOrFail($id);

        // Hapus gambar jika ada
        if ($kataSambutan->image && Storage::disk('public')->exists($kataSambutan->image)) {
            Storage::disk('public')->delete($kataSambutan->image);
        }

        // Menghapus data Kata Sambutan
        $kataSambutan->delete();

        // Redirect ke halaman daftar Kata Sambutan
        return redirect()->route('admin.kata-sambutan.index')->with('success', 'Kata Sambutan berhasil dihapus.');
    }
}
