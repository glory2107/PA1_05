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
        ]);

        $imagePath = $galeri->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('galeri/cover', 'public');
        }

        $galleryImages = $galeri->images ? json_decode($galeri->images, true) : [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $galleryImages[] = $file->store('galeri/images', 'public');
            }
        }

        $galeri->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'images'       => json_encode($galleryImages),
            'tanggal'      => now(),
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
            Storage::disk('public')->delete($galeri->image);
        }

        if ($galeri->images) {
            foreach ($galeri->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
