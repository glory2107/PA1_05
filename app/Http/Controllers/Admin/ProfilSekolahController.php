<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profils = ProfilSekolah::latest()->get();
        return view('admin.profil_sekolah.index', compact('profils'));
    }

    public function create()
    {
        return view('admin.profil_sekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profil_sekolah', 'public');
        }

        ProfilSekolah::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('admin.profil-sekolah.index')->with('success', 'Profil sekolah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $profil = ProfilSekolah::findOrFail($id);
        return view('admin.profil_sekolah.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = ProfilSekolah::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $profil->image;

        // Hapus gambar lama jika user centang "Hapus Gambar"
        if ($request->has('delete_image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null;
        }

        // Ganti dengan gambar baru jika user upload gambar
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('profil_sekolah', 'public');
        }

        $profil->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.profil-sekolah.index')->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profil = ProfilSekolah::findOrFail($id);

        if ($profil->image && Storage::disk('public')->exists($profil->image)) {
            Storage::disk('public')->delete($profil->image);
        }

        $profil->delete();

        return redirect()->route('admin.profil-sekolah.index')->with('success', 'Profil sekolah berhasil dihapus.');
    }
}
