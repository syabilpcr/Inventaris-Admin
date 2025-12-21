<?php

namespace App\Http\Controllers;

use App\Models\LokasiAset;
use App\Models\Aset;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // 1. Validasi Input
        $request->validate([
            'aset_id'       => 'required|exists:aset,aset_id',
            'lokasi_text'   => 'required|string|max:255',
            'rt'            => 'nullable|string|max:5',
            'rw'            => 'nullable|string|max:5',
            'keterangan'    => 'nullable|string',
            'foto_lokasi.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi multiple image
        ]);

        // 2. Simpan data ke tabel lokasi_aset
        // Pastikan nama modelnya adalah LokasiAset atau sesuai dengan nama model lokasi kamu
        $lokasi = LokasiAset::create([
            'aset_id'     => $request->aset_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'keterangan'  => $request->keterangan,
        ]);

        // 3. Upload Multiple Foto ke tabel media
        if ($request->hasFile('foto_lokasi')) {
            foreach ($request->file('foto_lokasi') as $index => $file) {
                // Simpan file fisik ke folder storage/app/public/lokasi
                $path = $file->store('lokasi', 'public');

                // Simpan data ke tabel media
                Media::create([
                    'ref_table'  => 'lokasi_aset', // Merujuk ke tabel lokasi_aset
                    'ref_id'     => $lokasi->lokasi_id, // ID dari lokasi yang baru saja dibuat
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi penempatan aset berhasil disimpan.');
    }

    public function edit($id)
    {
        $lokasi = LokasiAset::findOrFail($id);
        $assets = Aset::all();
        return view('pages.lokasi.edit', compact('lokasi', 'assets'));
    }

    public function update(Request $request, $id)
    {
        // 1. Cari data lokasi berdasarkan primary key (lokasi_id)
        $lokasi = LokasiAset::findOrFail($id);

        // 2. Validasi Input
        $request->validate([
            'aset_id'       => 'required|exists:aset,aset_id',
            'lokasi_text'   => 'required|string|max:255',
            'rt'            => 'nullable|string|max:5',
            'rw'            => 'nullable|string|max:5',
            'keterangan'    => 'nullable|string',
            'foto_lokasi.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 3. Update data teks lokasi
        $lokasi->update([
            'aset_id'     => $request->aset_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'keterangan'  => $request->keterangan,
        ]);

        // 4. Logika Upload Foto Baru (Jika Ada)
        if ($request->hasFile('foto_lokasi')) {
            // Ambil sort_order terakhir agar foto baru melanjutkan urutan foto lama
            $lastSort = Media::where('ref_table', 'lokasi_aset')
                ->where('ref_id', $id)
                ->max('sort_order') ?? -1;

            foreach ($request->file('foto_lokasi') as $index => $file) {
                // Simpan file fisik
                $path = $file->store('lokasi', 'public');

                // Simpan ke database media
                Media::create([
                    'ref_table'  => 'lokasi_aset', // Konsisten dengan fungsi store
                    'ref_id'     => $id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $lastSort + 1 + $index
                ]);
            }
        }

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Data lokasi aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lokasi = LokasiAset::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi aset berhasil dihapus.');
    }
}
