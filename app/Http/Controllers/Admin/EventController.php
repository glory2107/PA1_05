<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Menampilkan daftar event
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.event.index', compact('events'));
    }

    // Menampilkan form untuk membuat event baru
    public function create()
    {
        return view('admin.event.create');
    }

    // Menyimpan event yang baru dibuat
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal'     => 'required|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
        }

        Event::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'image'        => $imagePath,
            'tanggal'      => $request->tanggal,
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit event
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', compact('event'));
    }

    // Mengupdate data event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal'     => 'required|date',
        ]);

        $imagePath = $event->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('event_images', 'public');
        }

        $event->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'image'        => $imagePath,
            'tanggal'      => $request->tanggal,
            'modified_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui.');
    }

    // Menghapus event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus.');
    }
}
