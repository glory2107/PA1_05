<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    
    public function index()
    {
        $alumni = Alumni::latest()->get();
        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.create');
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
            $imagePath = $request->file('image')->store('alumni', 'public');
        }

        Alumni::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'image'        => $imagePath,
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $alumni->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('alumni', 'public');
        }

        $alumni->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'image'        => $imagePath,
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        if ($alumni->image && Storage::disk('public')->exists($alumni->image)) {
            Storage::disk('public')->delete($alumni->image);
        }

        $alumni->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil dihapus.');
    }
}
