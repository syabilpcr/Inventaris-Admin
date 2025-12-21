@extends('layouts.admin.app')

@section('content')
<style>
    body {
        background: #f9f3ef !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
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

    .form-control-custom {
        border: 2px solid #d2c1b6;
        border-radius: 12px;
        padding: 12px 15px;
        background: #fefcfb;
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

    /* Styles for Photo Preview */
    .current-photo-container {
        position: relative;
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .current-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #d2c1b6;
    }

    .upload-box {
        border: 2px dashed #d2c1b6;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-box:hover {
        border-color: #456882;
        background: #f0f4f7;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: #1b3c53;
    }

    .required-field::after {
        content: " *";
        color: #e74c3c;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Edit Lokasi Aset</h2>
            <p class="mb-0 opacity-75">Perbarui rincian dan foto penempatan aset</p>
        </div>
        <div>
            <i class="bi bi-pencil-square" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="card-soft">
        {{-- Enctype ditambahkan untuk upload file --}}
        <form action="{{ route('lokasi-aset.update', $lokasi->lokasi_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- KIRI: FORM DATA --}}
                <div class="col-lg-7">
                    <div class="form-section">
                        <h5><i class="bi bi-info-circle me-2"></i>Informasi Penempatan</h5>

                        <div class="mb-3">
                            <label class="form-label-custom required-field">Aset yang Ditempatkan</label>
                            <select name="aset_id" class="form-control form-control-custom" required>
                                @foreach ($assets as $a)
                                <option value="{{ $a->aset_id }}" {{ (old('aset_id', $lokasi->aset_id) == $a->aset_id) ? 'selected' : '' }}>
                                    {{ $a->kode_aset }} - {{ $a->nama_aset }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom required-field">Nama Lokasi / Ruangan</label>
                            <input type="text" name="lokasi_text" class="form-control form-control-custom"
                                value="{{ old('lokasi_text', $lokasi->lokasi_text) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">RT</label>
                                <input type="text" name="rt" class="form-control form-control-custom input-number"
                                    value="{{ old('rt', $lokasi->rt) }}" placeholder="000" maxlength="3">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">RW</label>
                                <input type="text" name="rw" class="form-control form-control-custom input-number"
                                    value="{{ old('rw', $lokasi->rw) }}" placeholder="000" maxlength="3">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label-custom">Keterangan</label>
                            <textarea name="keterangan" class="form-control form-control-custom" rows="3">{{ old('keterangan', $lokasi->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- KANAN: FOTO --}}
                <div class="col-lg-5">
                    <div class="form-section">
                        <h5><i class="bi bi-camera me-2"></i>Dokumentasi Foto</h5>

                        {{-- Foto Saat Ini --}}
                        <div class="mb-4">
                            <label class="form-label-custom d-block">Foto Saat Ini</label>
                            <div class="d-flex flex-wrap">
                                @php
                                $photos = $lokasi->media->where('ref_table', 'lokasi_aset');
                                @endphp

                                @forelse($photos as $photo)
                                <div class="current-photo-container">
                                    <img src="{{ asset('storage/' . $photo->file_name) }}" class="current-photo shadow-sm">
                                </div>
                                @empty
                                <div class="text-muted small py-3 border w-100 text-center rounded bg-light">
                                    <i class="bi bi-image me-1"></i> Belum ada foto terunggah
                                </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Update Foto --}}
                        <div class="mb-2">
                            <label class="form-label-custom">Ganti / Tambah Foto</label>
                            <div class="upload-box" onclick="document.getElementById('foto_lokasi').click()">
                                <i class="bi bi-upload text-primary fs-3"></i>
                                <p class="small text-muted mt-2 mb-0">Klik untuk memilih file foto baru</p>
                                <input type="file" name="foto_lokasi[]" id="foto_lokasi" class="d-none" multiple accept="image/*" onchange="previewImages(event)">
                            </div>
                            <div id="new-preview-grid" class="d-flex flex-wrap mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('lokasi-aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>

                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview foto baru yang dipilih
    function previewImages(event) {
        const grid = document.getElementById('new-preview-grid');
        grid.innerHTML = '';

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = "80px";
                img.style.height = "80px";
                img.style.objectFit = "cover";
                img.style.borderRadius = "8px";
                img.style.marginRight = "10px";
                img.style.marginBottom = "10px";
                img.style.border = "2px solid #456882";
                grid.appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }
    }

    // Input RT/RW angka saja
    document.querySelectorAll('.input-number').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
</script>

@endsection