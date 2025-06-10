<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // Tampilkan daftar slider
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    // Tampilkan form tambah slider baru
    public function create()
    {
        return view('admin.slider.create');
    }

    // Simpan slider baru (multiple images)
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('guest/images', 'public');
                $uploadedImages[] = basename($path);
            }
        }

        Slider::create([
            'image' => json_encode($uploadedImages), // Simpan sebagai JSON string
            'created_by' => Auth::id(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    // Tampilkan form edit slider
    public function edit(Slider $slider)
    {
        // Decode JSON gambar ke array agar bisa ditampilkan di view
        $slider->images = json_decode($slider->image, true);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_images' => 'nullable|string', // json string images yang dihapus
        ]);

        // Ambil gambar lama sebagai array
        $oldImages = json_decode($slider->image, true) ?? [];

        // Proses hapus gambar lama jika ada
        $removeImages = $request->input('remove_images') ? json_decode($request->input('remove_images'), true) : [];
        foreach ($removeImages as $imgToRemove) {
            if (($key = array_search($imgToRemove, $oldImages)) !== false) {
                // Hapus file fisik jika perlu
                Storage::disk('public')->delete('guest/images/' . $imgToRemove);
                unset($oldImages[$key]);
            }
        }
        $oldImages = array_values($oldImages); // reindex

        // Upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('guest/images', 'public');
                $oldImages[] = basename($path);
            }
        }

        $slider->update([
            'image' => json_encode($oldImages),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil diperbarui!');
    }


    // Hapus slider
    public function destroy(Slider $slider)
    {
        // Hapus semua file gambar slider dari storage
        $images = json_decode($slider->image, true) ?? [];
        foreach ($images as $img) {
            Storage::disk('public')->delete('guest/images/' . $img);
        }

        // Hapus data slider
        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil dihapus!');
    }

    // (Opsional) Tampilkan detail slider
    public function show(Slider $slider)
    {
        $slider->images = json_decode($slider->image, true);
        return view('admin.slider.show', compact('slider'));
    }
}
