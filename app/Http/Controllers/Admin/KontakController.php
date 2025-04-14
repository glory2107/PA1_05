<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::latest()->get();
        return view('admin.kontak.index', compact('kontaks'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'value' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Kontak::create([
            'icon'        => $request->icon,
            'value'       => $request->value,
            'status'      => $request->status,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $kontak = Kontak::findOrFail($id);

        $request->validate([
            'icon' => 'required|string|max:255',
            'value' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kontak->update([
            'icon'        => $request->icon,
            'value'       => $request->value,
            'status'      => $request->status,
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil dihapus.');
    }
}