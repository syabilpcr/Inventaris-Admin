<?php

namespace App\Http\Controllers;

use App\Models\MutasiAset;
use App\Models\Aset;
use Illuminate\Http\Request;

class MutasiAsetController extends Controller
{
    public function index(Request $request)
    {
       
        $mutasi = MutasiAset::with('aset')
            ->search($request)
            ->filter($request)
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString(); 

        return view('pages.mutasi.index', compact('mutasi'));
    }

    public function create()
    {
        $assets = Aset::all();
        return view('pages.mutasi.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id'      => 'required|exists:aset,aset_id',
            'tanggal'      => 'required|date',
            'jenis_mutasi' => 'required|string',
            'keterangan'   => 'nullable|string',
        ]);

        MutasiAset::create($request->all());

        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil dicatat.');
    }

    public function edit($id)
    {
        $mutasi = MutasiAset::findOrFail($id);
        $assets = Aset::all();
        return view('pages.mutasi.edit', compact('mutasi', 'assets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aset_id'      => 'required|exists:aset,aset_id',
            'tanggal'      => 'required|date',
            'jenis_mutasi' => 'required|string',
            'keterangan'   => 'nullable|string',
        ]);

        $mutasi = MutasiAset::findOrFail($id);
        $mutasi->update($request->all());

        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MutasiAset::findOrFail($id)->delete();
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil dihapus.');
    }
}
