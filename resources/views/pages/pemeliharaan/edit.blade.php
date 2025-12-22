@extends('layouts.admin.app')

@section('content')
<style>
    body {
        background: #f9f3ef !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header-custom {
        background: linear-gradient(135deg, #456882, #1b3c53);
        border-radius: 20px;
        padding: 35px 40px;
        color: white;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 25px rgba(27, 60, 83, 0.15);
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
        padding: 25px;
        margin-bottom: 25px;
        border-left: 4px solid #456882;
    }

    .form-section h5 {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9e1d9;
    }

    .form-control-custom {
        border: 2px solid #d2c1b6;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: #456882;
        box-shadow: 0 0 0 3px rgba(69, 104, 130, 0.1);
        outline: none;
    }

    .form-label-custom {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Photo Management */
    .photo-item-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
    }

    .photo-current {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #d2c1b6;
    }

    .upload-box-custom {
        border: 2px dashed #456882;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        background: #fefcfb;
        cursor: pointer;
        transition: 0.3s;
    }

    .upload-box-custom:hover {
        background: #f1f5f8;
        border-color: #1b3c53;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(27, 60, 83, 0.2);
        color: white;
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: #1b3c53;
        text-decoration: none;
    }
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Edit Log Pemeliharaan</h2>
            <p class="mb-0 opacity-75">Perbarui informasi perawatan aset secara detail</p>
        </div>
        <i class="bi bi-pencil-square" style="font-size: 55px; opacity: .85;"></i>
    </div>

    <div class="card-soft">
        <form action="{{ route('pemeliharaan.update', $pemeliharaan->pemeliharaan_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-lg-11">
                    
                    {{-- SEKSI DATA UTAMA --}}
                    <div class="form-section">
                        <h5><i class="bi bi-tools me-2"></i>Informasi Pemeliharaan</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Pilih Aset</label>
                                <select name="aset_id" class="form-select form-control-custom shadow-none" required>
                                    @foreach($assets as $a)
                                    <option value="{{ $a->aset_id }}" {{ $pemeliharaan->aset_id == $a->aset_id ? 'selected' : '' }}>
                                        {{ $a->kode_aset }} - {{ $a->nama_aset }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tanggal Pemeliharaan</label>
                                <input type="date" name="tanggal" class="form-control form-control-custom shadow-none" value="{{ $pemeliharaan->tanggal }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Tindakan / Perbaikan</label>
                                <textarea name="tindakan" class="form-control form-control-custom shadow-none" rows="3" placeholder="Jelaskan detail perbaikan yang dilakukan..." required>{{ $pemeliharaan->tindakan }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Biaya (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 12px 0 0 12px; border: 2px solid #d2c1b6; border-right: none; background: #f9f3ef; color: #1b3c53; font-weight: bold;">Rp</span>
                                    <input type="number" name="biaya" class="form-control form-control-custom shadow-none" style="border-radius: 0 12px 12px 0;" value="{{ (int)$pemeliharaan->biaya }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Nama Pelaksana</label>
                                <input type="text" name="pelaksana" class="form-control form-control-custom shadow-none" value="{{ $pemeliharaan->pelaksana }}" placeholder="Nama teknisi atau vendor" required>
                            </div>
                        </div>
                    </div>

                    {{-- SEKSI DOKUMENTASI --}}
                    <div class="form-section">
                        <h5><i class="bi bi-images me-2"></i>Dokumentasi Foto</h5>
                        
                        {{-- Galeri Foto Saat Ini --}}
                        <div class="mb-4">
                            <label class="form-label-custom d-block mb-3">Foto Saat Ini:</label>
                            <div class="d-flex flex-wrap gap-3">
                                @forelse($pemeliharaan->media->where('ref_table', 'pemeliharaan') as $m)
                                <div class="photo-item-wrapper" id="media-{{ $m->media_id }}">
                                    <img src="{{ asset('storage/' . $m->file_name) }}" class="photo-current">
                                    {{-- Jika ada fitur hapus media satuan, tambahkan tombol di sini --}}
                                </div>
                                @empty
                                <div class="w-100 p-4 text-center rounded-3" style="background: #f8f9fa; border: 1px dashed #d2c1b6;">
                                    <p class="text-muted mb-0 small italic">Belum ada foto dokumentasi.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <hr style="border-top: 2px dashed #e9e1d9;">

                        {{-- Upload Foto Baru --}}
                        <div class="mt-4">
                            <label class="form-label-custom">Tambah Dokumentasi Baru</label>
                            <div class="upload-box-custom" onclick="document.getElementById('foto_pemeliharaan').click()">
                                <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 2rem;"></i>
                                <p class="mb-0 mt-2 fw-bold" style="color: #1b3c53;">Klik untuk pilih foto baru</p>
                                <p class="text-muted small">Mendukung banyak file sekaligus (JPG, PNG)</p>
                                <input type="file" name="foto_pemeliharaan[]" id="foto_pemeliharaan" class="d-none" multiple accept="image/*" onchange="previewImages(event)">
                            </div>
                            <div id="image-preview-grid" class="d-flex flex-wrap gap-2 mt-3"></div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-save me-2"></i> Perbarui Log Pemeliharaan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImages(event) {
        const grid = document.getElementById('image-preview-grid');
        grid.innerHTML = '';
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '12px';
                img.style.border = '2px solid #456882';
                img.className = 'animate__animated animate__zoomIn';
                grid.appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }
    }
</script>
@endsection