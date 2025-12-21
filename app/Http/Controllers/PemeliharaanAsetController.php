<?php

// app/Http/Controllers/PemeliharaanAsetController.php

namespace App\Http\Controllers;

use App\Models\PemeliharaanAset;
use App\Models\Aset;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class PemeliharaanAsetController extends Controller
{
    public function index()
    {
        $pemeliharaan = PemeliharaanAset::with('aset')->latest()->get();
        return view('pages.pemeliharaan.index', compact('pemeliharaan'));
    }

    public function create()
    {
        $assets = Aset::all();
        return view('pages.pemeliharaan.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id'       => 'required|exists:aset,aset_id',
            'tanggal'       => 'required|date',
            'tindakan'      => 'required',
            'biaya'         => 'required|numeric',
            'pelaksana'     => 'required|string|max:255',
            'foto_pemeliharaan.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Tambahkan validasi foto
        ]);

        // 1. Simpan data teks pemeliharaan
        $pemeliharaan = PemeliharaanAset::create($request->all());

        // 2. Simpan Foto (Jika ada)
        if ($request->hasFile('foto_pemeliharaan')) {
            foreach ($request->file('foto_pemeliharaan') as $index => $file) {
                $path = $file->store('pemeliharaan', 'public');

                Media::create([
                    'ref_table'  => 'pemeliharaan',
                    'ref_id'     => $pemeliharaan->pemeliharaan_id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemeliharaan = PemeliharaanAset::findOrFail($id);
        $assets = Aset::all();
        return view('pages.pemeliharaan.edit', compact('pemeliharaan', 'assets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aset_id'       => 'required|exists:aset,aset_id',
            'tanggal'       => 'required|date',
            'tindakan'      => 'required',
            'biaya'         => 'required|numeric',
            'pelaksana'     => 'required|string|max:255',
            'foto_pemeliharaan.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Tambahkan validasi foto
        ]);

        $pemeliharaan = PemeliharaanAset::findOrFail($id);
        $pemeliharaan->update($request->all());

        // Logika Tambah Foto Baru tanpa menghapus yang lama
        if ($request->hasFile('foto_pemeliharaan')) {
            // Ambil urutan terakhir foto yang sudah ada
            $lastSort = Media::where('ref_table', 'pemeliharaan')
                ->where('ref_id', $id)
                ->max('sort_order') ?? -1;

            foreach ($request->file('foto_pemeliharaan') as $index => $file) {
                $path = $file->store('pemeliharaan', 'public');

                Media::create([
                    'ref_table'  => 'pemeliharaan',
                    'ref_id'     => $id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $lastSort + 1 + $index
                ]);
            }
        }

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemeliharaan = PemeliharaanAset::findOrFail($id);
        $pemeliharaan->delete();

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil dihapus.');
    }
}
