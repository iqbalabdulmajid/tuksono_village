<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa; // Make sure you have this model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perangkat = PerangkatDesa::latest()->paginate(10);
        return view('admins.perangkat.index', compact('perangkat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.perangkat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat', 'public');
        }

        PerangkatDesa::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.perangkat.index')->with('success', 'Data perangkat desa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PerangkatDesa $perangkat)
    {
        return view('admins.perangkat.show', compact('perangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerangkatDesa $perangkat)
    {
        return view('admins.perangkat.edit', compact('perangkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerangkatDesa $perangkat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $perangkat->foto;
        if ($request->hasFile('foto')) {
            // Delete old photo if it exists
            if ($perangkat->foto) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $fotoPath = $request->file('foto')->store('perangkat', 'public');
        }

        $perangkat->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.perangkat.index')->with('success', 'Data perangkat desa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerangkatDesa $perangkat)
    {
        if ($perangkat->foto) {
            Storage::disk('public')->delete($perangkat->foto);
        }
        $perangkat->delete();

        return redirect()->route('admin.perangkat.index')->with('success', 'Data perangkat desa berhasil dihapus.');
    }
}
