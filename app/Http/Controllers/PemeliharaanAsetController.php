<?php

// app/Http/Controllers/PemeliharaanAsetController.php

namespace App\Http\Controllers;

use App\Models\PemeliharaanAset;
use App\Models\Aset;
use Illuminate\Http\Request;

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
            'aset_id'   => 'required|exists:aset,aset_id',
            'tanggal'   => 'required|date',
            'tindakan'  => 'required',
            'biaya'     => 'required|numeric',
            'pelaksana' => 'required|string|max:255',
        ]);

        PemeliharaanAset::create($request->all());

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
            'aset_id'   => 'required|exists:aset,aset_id',
            'tanggal'   => 'required|date',
            'tindakan'  => 'required',
            'biaya'     => 'required|numeric',
            'pelaksana' => 'required|string|max:255',
        ]);

        $pemeliharaan = PemeliharaanAset::findOrFail($id);
        $pemeliharaan->update($request->all());

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
