<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;
use Illuminate\Http\Request;
 use Carbon\Carbon; // Pastikan import ini ada di bagian atas file
class KategoriAsetController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index(Request $request)
{
    // Mengambil parameter dari URL dengan default value
    $search = $request->get('search');
    $sort = $request->get('sort', 'created_at'); // Default urut berdasarkan tgl dibuat
    $order = $request->get('order', 'desc');    // Default urutan terbaru (desc)

    $kategoris = KategoriAset::query()
        // Fungsi Search
        ->when($search, function ($query) use ($search) {
            return $query->where('nama', 'LIKE', "%{$search}%")
                         ->orWhere('kode', 'LIKE', "%{$search}%")
                         ->orWhere('deskripsi', 'LIKE', "%{$search}%");
        })
        // Fungsi Sort
        ->orderBy($sort, $order)
        // Fungsi Pagination
        ->paginate(10)
        ->withQueryString();

    return view('pages.kategori.index', compact('kategoris'));
}

    /**
     * Menampilkan form untuk membuat kategori baru (biasanya di modal).
     */
    public function create()
    {
        return view('pages.kategori.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|unique:kategori_aset,kode',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriAset::create($request->all());

        return redirect()->route('kategori-aset.index')
            ->with('success', 'Kategori aset berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu kategori (opsional).
     */
    public function show(KategoriAset $kategoriAset)
    {
        return view('admin.kategori.show', compact('kategoriAset'));
    }

    /**
     * Menampilkan form untuk edit kategori.
     */
    public function edit($id)
    {
        $kategori = KategoriAset::findOrFail($id);
        return view('pages.kategori.edit', compact('kategori'));
    }

    /**
     * Memperbarui kategori di database.
     */

public function update(Request $request, $id)
{
    $kategori = KategoriAset::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'kode' => 'required|string|unique:kategori_aset,kode,' . $id . ',kategori_id',
        'deskripsi' => 'nullable|string',
    ]);

    // Ambil semua data input
    $data = $request->all();
    
    // Paksa update kolom updated_at dengan waktu Jakarta sekarang
    $kategori->updated_at = Carbon::now('Asia/Jakarta');
    $kategori->fill($data);
    $kategori->save();

    return redirect()->route('kategori-aset.index')
        ->with('success', 'Kategori aset berhasil diperbarui pada ' . Carbon::now('Asia/Jakarta')->format('H:i:s'));
}

    /**
     * Menghapus kategori dari database.
     */
    public function destroy($id)
    {
        $kategori = KategoriAset::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-aset.index')
            ->with('success', 'Kategori aset berhasil dihapus!');
    }
}
