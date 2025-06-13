<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'image'        => $imagePath,
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, $id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $ekstrakurikuler->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'image'        => $imagePath,
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        if ($ekstrakurikuler->image && Storage::disk('public')->exists($ekstrakurikuler->image)) {
            Storage::disk('public')->delete($ekstrakurikuler->image);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

