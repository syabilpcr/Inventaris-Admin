<?php

namespace App\Http\Controllers;

use App\Models\LokasiAset;
use App\Models\Aset;
use Illuminate\Http\Request;

class LokasiAsetController extends Controller
{
    public function index()
    {
        $locations = LokasiAset::with('aset')->get();
        return view('pages.lokasi.index', compact('locations'));
    }

    public function create()
    {
        // Mengambil data aset untuk dipilih di form
        $assets = Aset::all();
        return view('pages.lokasi.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:aset,aset_id',
            'lokasi_text' => 'required|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'keterangan' => 'nullable|string',
        ]);

        LokasiAset::create($request->all());

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $lokasi = LokasiAset::findOrFail($id);
        $assets = Aset::all();
        return view('pages.lokasi.edit', compact('lokasi', 'assets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aset_id' => 'required|exists:aset,aset_id',
            'lokasi_text' => 'required|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'keterangan' => 'nullable|string',
        ]);

        $lokasi = LokasiAset::findOrFail($id);
        $lokasi->update($request->all());

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lokasi = LokasiAset::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi aset berhasil dihapus.');
    }
}
