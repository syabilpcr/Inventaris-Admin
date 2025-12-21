<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
        // Menggunakan eager loading (with) agar lebih cepat
        $aset = Aset::with('kategori')->get();
        return view('pages.aset.index', compact('aset'));
    }

    public function create()
    {
        $kategori = KategoriAset::all();
        return view('pages.aset.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'     => 'required|exists:kategori_aset,kategori_id',
            'kode_aset'       => 'required|unique:aset,kode_aset',
            'nama_aset'       => 'required|string|max:255',
            'tgl_perolehan'   => 'required|date',
            'nilai_perolehan' => 'required|numeric',
            'kondisi'         => 'required|string',
        ]);

        Aset::create($request->all());

        return redirect()->route('aset.index')->with('success', 'Aset baru berhasil disimpan.');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        $kategori = KategoriAset::all();
        return view('pages.aset.edit', compact('aset', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        $request->validate([
            'kategori_id'     => 'required|exists:kategori_aset,kategori_id',
            'kode_aset'       => 'required|unique:aset,kode_aset,' . $id . ',aset_id',
            'nama_aset'       => 'required|string|max:255',
            'tgl_perolehan'   => 'required|date',
            'nilai_perolehan' => 'required|numeric',
            'kondisi'         => 'required|string',
        ]);

        $aset->update($request->all());

        return redirect()->route('aset.index')->with('success', 'Data aset diperbarui.');
    }

    public function destroy($id)
    {
        Aset::findOrFail($id)->delete();
        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus.');
    }
}
