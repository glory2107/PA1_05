<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:5120',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'file'         => $filePath,
            'tanggal'      => $request->tanggal,
            'status'       => $request->status,
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:5120',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        $filePath = $pengumuman->file;
        if ($request->hasFile('file')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('pengumuman', 'public');
        }

        $pengumuman->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'file'         => $filePath,
            'tanggal'      => $request->tanggal,
            'status'       => $request->status,
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->file && Storage::disk('public')->exists($pengumuman->file)) {
            Storage::disk('public')->delete($pengumuman->file);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}

