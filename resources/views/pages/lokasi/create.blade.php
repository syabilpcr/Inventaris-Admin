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

    /* Upload Styling */
    .upload-area {
        border: 2px dashed #d2c1b6;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        background: #fdfaf8;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #456882;
        background: #f0f4f7;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .preview-item {
        position: relative;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e9e1d9;
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
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
            <h2 class="fw-bold mb-2">Tambah Lokasi Aset</h2>
            <p class="mb-0 opacity-75">Tentukan titik lokasi penempatan aset baru</p>
        </div>
        <i class="bi bi-geo-alt-fill" style="font-size: 55px; opacity: .85;"></i>
    </div>

    <div class="card-soft">
        {{-- Penambahan enctype agar bisa upload file --}}
        <form action="{{ route('lokasi-aset.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- SISI KIRI: DATA LOKASI --}}
                <div class="col-lg-7">
                    <div class="form-section">
                        <h5><i class="bi bi-info-circle me-2"></i>Informasi Lokasi</h5>

                        <div class="mb-3">
                            <label class="form-label-custom required-field">Pilih Aset</label>
                            <select name="aset_id" class="form-control form-control-custom @error('aset_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Aset --</option>
                                @foreach ($assets as $a)
                                <option value="{{ $a->aset_id }}" {{ old('aset_id') == $a->aset_id ? 'selected' : '' }}>
                                    {{ $a->kode_aset }} - {{ $a->nama_aset }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom required-field">Nama Lokasi / Gedung</label>
                            <input type="text" name="lokasi_text" class="form-control form-control-custom"
                                value="{{ old('lokasi_text') }}" placeholder="Contoh: Lab Komputer 1" required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label-custom">RT</label>
                                <input type="text" name="rt" class="form-control form-control-custom input-number"
                                    value="{{ old('rt') }}" placeholder="001" maxlength="3">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label-custom">RW</label>
                                <input type="text" name="rw" class="form-control form-control-custom input-number"
                                    value="{{ old('rw') }}" placeholder="005" maxlength="3">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label-custom">Keterangan Tambahan</label>
                            <textarea name="keterangan" class="form-control form-control-custom" rows="3"
                                placeholder="Detail posisi (misal: Pojok kiri rak 2)">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SISI KANAN: UPLOAD FOTO --}}
                <div class="col-lg-5">
                    <div class="form-section h-100">
                        <h5><i class="bi bi-camera me-2"></i>Foto Lokasi</h5>
                        <p class="small text-muted mb-3">Unggah foto penempatan aset di lokasi ini untuk mempermudah pencarian fisik.</p>

                        <div class="upload-area" onclick="document.getElementById('foto_lokasi').click()">
                            <i class="bi bi-cloud-arrow-up text-primary mb-2" style="font-size: 40px;"></i>
                            <p class="mb-0 fw-bold" id="upload-text">Klik untuk pilih foto</p>
                            <p class="small text-muted">Mendukung JPEG, PNG, JPG (Maks. 2MB)</p>

                            {{-- Input file tersembunyi --}}
                            <input type="file" name="foto_lokasi[]" id="foto_lokasi" class="d-none"
                                multiple accept="image/*" onchange="previewImages(event)">
                        </div>

                        <div class="preview-grid" id="preview-grid">
                            {{-- Preview gambar muncul di sini --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('lokasi-aset.index') }}" class="btn btn-secondary-custom px-4">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom px-5 shadow">
                    <i class="bi bi-save me-2"></i> Simpan Lokasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi Preview Multiple Gambar
    function previewImages(event) {
        const grid = document.getElementById('preview-grid');
        const text = document.getElementById('upload-text');
        grid.innerHTML = ''; // Reset preview

        const files = event.target.files;
        if (files.length > 0) {
            text.innerText = `${files.length} Foto dipilih`;
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item shadow-sm';
                    div.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    grid.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    // Hanya angka untuk RT/RW
    document.querySelectorAll('.input-number').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
</script>
@endsection