@extends('layouts.admin.app')

@section('content')

<style>
    body {
        background: #f9f3ef !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-soft {
        background: white;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9e1d9;
    }

    .form-section {
        background: #fefcfb;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #456882;
    }

    .form-section h5 {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 15px;
        border-bottom: 1px solid #e9e1d9;
        padding-bottom: 10px;
    }

    /* Styling Gallery Foto Eksisting */
    .photo-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }

    .photo-item {
        position: relative;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #d2c1b6;
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-delete-photo {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(231, 76, 60, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .btn-delete-photo:hover {
        background: #c0392b;
        transform: scale(1.1);
    }

    .preview-new-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 8px;
        margin-top: 10px;
    }

    .preview-new-item {
        height: 80px;
        border-radius: 8px;
        border: 2px dashed #456882;
        overflow: hidden;
    }

    .preview-new-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #456882, #1b3c53);
        color: white;
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        color: #1b3c53;
        font-weight: 600;
        text-decoration: none;
    }
</style>

<div class="container-fluid px-4">

    <div class="mb-4">
        <h2 class="fw-bold" style="color:#1b3c53;">
            <i class="bi bi-pencil-square me-2"></i>Edit Data Aset
        </h2>
        <small style="color:#456882;">Perbarui informasi dan dokumentasi aset Anda</small>
    </div>

    <div class="card-soft">
        {{-- Pastikan enctype ditambahkan untuk upload file --}}
        <form action="{{ route('aset.update', $aset->aset_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- SISI KIRI: FORM DATA --}}
                <div class="col-lg-8">
                    <div class="form-section">
                        <h5><i class="bi bi-card-text me-2"></i>Detail Informasi</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Kategori Aset</label>
                                <select name="kategori_id" class="form-select shadow-none" style="border: 2px solid #d2c1b6; border-radius: 10px;" required>
                                    @foreach ($kategori as $k)
                                    <option value="{{ $k->kategori_id }}" {{ old('kategori_id', $aset->kategori_id) == $k->kategori_id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Kode Aset</label>
                                <input type="text" name="kode_aset" class="form-control shadow-none" style="border: 2px solid #d2c1b6; border-radius: 10px;" value="{{ old('kode_aset', $aset->kode_aset) }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Nama Aset</label>
                                <input type="text" name="nama_aset" class="form-control shadow-none" style="border: 2px solid #d2c1b6; border-radius: 10px;" value="{{ old('nama_aset', $aset->nama_aset) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="mb-2">Tgl Perolehan</label>
                                <input type="date" name="tgl_perolehan" class="form-control shadow-none" style="border: 2px solid #d2c1b6; border-radius: 10px;" value="{{ \Carbon\Carbon::parse($aset->tgl_perolehan)->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="mb-2">Nilai Perolehan</label>
                                <input type="number" name="nilai_perolehan" class="form-control shadow-none" style="border: 2px solid #d2c1b6; border-radius: 10px;" value="{{ $aset->nilai_perolehan }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="mb-2">Kondisi</label>
                                <select name="kondisi" class="form-select shadow-none" style="border: 2px solid #d2c1b6; border-radius: 10px;" required>
                                    @foreach (['Sangat Baik','Baik','Rusak Ringan','Rusak Berat'] as $kondisi)
                                    <option value="{{ $kondisi }}" {{ $aset->kondisi == $kondisi ? 'selected' : '' }}>{{ $kondisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SISI KANAN: MANAGEMEN FOTO --}}
                <div class="col-lg-4">
                    <div class="form-section h-100">
                        <h5><i class="bi bi-images me-2"></i>Dokumentasi Foto</h5>

                        {{-- Foto yang sudah ada --}}
                        <label class="small text-muted mb-2">Foto Saat Ini:</label>
                        <div class="photo-gallery mb-4">
                            @forelse($aset->media->where('ref_table', 'aset') as $m)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $m->file_name) }}" alt="Foto Aset">
                                {{-- Tombol hapus foto bisa diarahkan ke route khusus hapus media --}}
                                <button type="button" class="btn-delete-photo" onclick="confirmDeleteMedia({{ $m->media_id }})">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            @empty
                            <p class="text-muted small italic text-center w-100">Belum ada foto.</p>
                            @endforelse
                        </div>

                        <hr>

                        {{-- Input Tambah Foto Baru --}}
                        <label class="small text-muted mb-2">Tambah Foto Baru:</label>
                        <input type="file" name="foto_aset[]" id="foto_aset" class="form-control form-control-sm" multiple accept="image/*" onchange="previewNewPhotos(event)">
                        <div class="preview-new-grid" id="preview-new-grid"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-arrow-repeat me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script Preview New Photos --}}
<script>
    function previewNewPhotos(event) {
        const grid = document.getElementById('preview-new-grid');
        grid.innerHTML = '';
        const files = event.target.files;

        if (files) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-new-item';
                    div.innerHTML = `<img src="${e.target.result}">`;
                    grid.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    function confirmDeleteMedia(mediaId) {
        if (confirm('Hapus foto ini secara permanen?')) {
            // Logika penghapusan media melalui AJAX atau Redirect ke Route khusus
            // Contoh: window.location.href = "/media/delete/" + mediaId;
        }
    }
</script>

@endsection