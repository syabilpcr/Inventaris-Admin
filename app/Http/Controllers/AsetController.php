<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Media;
use App\Models\KategoriAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto_aset.*'     => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // 1. Simpan data aset
        $aset = Aset::create($request->all());

        // 2. Logika Multiple Upload Foto
        if ($request->hasFile('foto_aset')) {
            foreach ($request->file('foto_aset') as $index => $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('aset', $fileName, 'public');

                // Simpan ke tabel media
                Media::create([
                    'ref_table' => 'aset',
                    'ref_id'    => $aset->aset_id, // Mengambil ID dari aset yang baru dibuat
                    'file_name' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => $index
                ]);
            }
        }

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
            'foto_aset.*'     => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Update data aset
        $aset->update($request->all());

        // 2. Tambah foto baru jika ada yang diupload
        if ($request->hasFile('foto_aset')) {
            // Mendapatkan sort_order terakhir agar urutannya berlanjut
            $lastSort = Media::where('ref_table', 'aset')->where('ref_id', $id)->max('sort_order') ?? -1;

            foreach ($request->file('foto_aset') as $index => $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('aset', $fileName, 'public');

                Media::create([
                    'ref_table' => 'aset',
                    'ref_id'    => $id,
                    'file_name' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => $lastSort + 1 + $index
                ]);
            }
        }

        return redirect()->route('aset.index')->with('success', 'Data aset diperbarui.');
    }

    public function destroy($id)
    {
        Aset::findOrFail($id)->delete();
        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus.');
    }
}
