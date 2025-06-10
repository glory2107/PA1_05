<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('galeri/cover', 'public');
        }

        $galleryImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $galleryImages[] = $file->store('galeri/images', 'public');
            }
        }

        Galeri::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'images'       => json_encode($galleryImages),
            'tanggal'      => now(),
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_images' => 'nullable|string', // JSON string gambar yg dihapus
            'remove_cover' => 'nullable|boolean',
        ]);

        // Handle gambar cover
        $imagePath = $galeri->image;
        if ($request->has('remove_cover') && $request->remove_cover) {
            // hapus gambar cover lama jika checkbox di-check
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null; // set jadi null
        }

        if ($request->hasFile('image')) {
            // hapus cover lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('galeri/cover', 'public');
        }

        // Ambil array gambar lama yang tersimpan di DB
        $galleryImages = $galeri->images ? json_decode($galeri->images, true) : [];

        // Proses gambar yang ingin dihapus dari input remove_images
        $imagesToRemove = [];
        if ($request->remove_images) {
            $imagesToRemove = json_decode($request->remove_images, true);
            if (is_array($imagesToRemove)) {
                foreach ($imagesToRemove as $imgToRemove) {
                    // hapus file dari storage jika ada
                    if (Storage::disk('public')->exists($imgToRemove)) {
                        Storage::disk('public')->delete($imgToRemove);
                    }
                    // hapus juga dari array galleryImages
                    $key = array_search($imgToRemove, $galleryImages);
                    if ($key !== false) {
                        unset($galleryImages[$key]);
                    }
                }
                // Reset array keys agar urut rapi setelah unset
                $galleryImages = array_values($galleryImages);
            }
        }

        // Tambahkan gambar baru yang diupload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $galleryImages[] = $file->store('galeri/images', 'public');
            }
        }

        // Update data galeri
        $galeri->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'images'       => json_encode($galleryImages),
            'tanggal'      => $request->tanggal ?? now(),
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus gambar cover jika ada
        if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
            Storage::disk('public')->delete($galeri->image);
        }

        // Hapus gambar-gambar gallery yang tersimpan dalam JSON
        if ($galeri->images) {
            $galleryImages = json_decode($galeri->images, true);
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
