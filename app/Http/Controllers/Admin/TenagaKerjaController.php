<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenagaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TenagaKerjaController extends Controller
{
    public function index()
    {
        $tenagaKerja = TenagaKerja::latest()->get(); // Menampilkan semua data tenaga kerja
        return view('admin.tenaga_kerja.index', compact('tenagaKerja'));
    }

    public function create()
    {
        return view('admin.tenaga_kerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'jabatan'    => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tenaga_kerja', 'public');
        }

        TenagaKerja::create([
            'name'        => $request->name,
            'jabatan'     => $request->jabatan,
            'image'       => $imagePath,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.tenaga-kerja.index')->with('success', 'Tenaga kerja berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tenagaKerja = TenagaKerja::findOrFail($id);
        return view('admin.tenaga_kerja.edit', compact('tenagaKerja'));
    }

    public function update(Request $request, $id)
    {
        $tenagaKerja = TenagaKerja::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'jabatan'    => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $tenagaKerja->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('tenaga_kerja', 'public');
        }

        $tenagaKerja->update([
            'name'        => $request->name,
            'jabatan'     => $request->jabatan,
            'image'       => $imagePath,
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('admin.tenaga-kerja.index')->with('success', 'Tenaga kerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tenagaKerja = TenagaKerja::findOrFail($id);

        // Hapus gambar jika ada
        if ($tenagaKerja->image && Storage::disk('public')->exists($tenagaKerja->image)) {
            Storage::disk('public')->delete($tenagaKerja->image);
        }

        $tenagaKerja->delete();

        return redirect()->route('admin.tenaga-kerja.index')->with('success', 'Tenaga kerja berhasil dihapus.');
    }
}
