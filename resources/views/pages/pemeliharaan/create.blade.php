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
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fefcfb;
    }

    .form-control-custom:focus {
        border-color: #456882;
        box-shadow: 0 0 0 3px rgba(69, 104, 130, 0.1);
        background: white;
    }

    .form-label-custom {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #456882, #1b3c53);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(69, 104, 130, 0.3);
        color: white;
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #1b3c53;
    }

    .btn-secondary-custom:hover {
        background: #c4b0a3;
        transform: translateY(-2px);
        color: #1b3c53;
    }

    .preview-container {
        border: 2px dashed #d2c1b6;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #fefcfb;
        transition: all 0.3s ease;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        cursor: pointer;
    }

    .preview-container:hover {
        border-color: #456882;
        background: #f9f3ef;
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

    .required-field::after {
        content: " *";
        color: #e74c3c;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #1b3c53;
        height: 100px;
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Tambah Log Pemeliharaan</h2>
            <p class="mb-0 opacity-75">Catat aktivitas perawatan aset secara detail</p>
        </div>
        <div>
            <i class="bi bi-tools" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="card-soft">
        <form action="{{ route('pemeliharaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    {{-- INFORMASI DASAR PEMELIHARAAN --}}
                    <div class="form-section">
                        <h5><i class="bi bi-info-circle me-2"></i>Informasi Pemeliharaan</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Pilih Aset</label>
                                <select name="aset_id" class="form-control form-control-custom @error('aset_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Aset --</option>
                                    @foreach($assets as $a)
                                    <option value="{{ $a->aset_id }}" {{ old('aset_id') == $a->aset_id ? 'selected' : '' }}>
                                        {{ $a->kode_aset }} - {{ $a->nama_aset }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Tanggal Pemeliharaan</label>
                                <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom required-field">Tindakan / Perbaikan</label>
                            <textarea name="tindakan" class="form-control form-control-custom" rows="3" placeholder="Jelaskan detail aktivitas perawatan atau perbaikan..." required>{{ old('tindakan') }}</textarea>
                        </div>
                    </div>

                    {{-- BIAYA & PELAKSANA --}}
                    <div class="form-section">
                        <h5><i class="bi bi-person-gear me-2"></i>Biaya & Pelaksana</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Biaya Perbaikan (Rp)</label>
                                <input type="number" name="biaya" class="form-control form-control-custom" value="{{ old('biaya') }}" placeholder="Masukkan nominal biaya" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Nama Pelaksana</label>
                                <input type="text" name="pelaksana" class="form-control form-control-custom" value="{{ old('pelaksana') }}" placeholder="Contoh: Teknisi / Nama Vendor" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- UPLOAD DOKUMENTASI SECTION --}}
                <div class="col-lg-4">
                    <div class="form-section h-100">
                        <h5><i class="bi bi-camera me-2"></i>Dokumentasi</h5>
                        <div class="preview-container" id="dropzone" onclick="document.getElementById('foto_pemeliharaan').click()">
                            <i class="bi bi-cloud-arrow-up fs-1 mb-2" id="icon-upload" style="color: #d2c1b6;"></i>
                            <p class="mb-2" id="text-upload" style="color: #456882;">Pilih foto dokumentasi</p>
                            
                            <input type="file" name="foto_pemeliharaan[]" id="foto_pemeliharaan" class="d-none" multiple accept="image/*" onchange="previewMultipleImages(event)">
                            
                            <button type="button" class="btn btn-secondary-custom btn-sm">Browse Files</button>
                            <small class="help-text d-block mt-2 text-muted">Bisa pilih lebih dari 1 foto</small>
                        </div>

                        {{-- Grid Preview --}}
                        <div class="preview-grid" id="image-preview-grid"></div>
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Simpan Log
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT UNTUK PREVIEW GAMBAR --}}
<script>
    function previewMultipleImages(event) {
        const grid = document.getElementById('image-preview-grid');
        const icon = document.getElementById('icon-upload');
        const text = document.getElementById('text-upload');
        const files = event.target.files;

        grid.innerHTML = ''; // Reset preview

        if (files.length > 0) {
            icon.style.display = 'none';
            text.style.display = 'none';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    div.innerHTML = `<img src="${e.target.result}">`;
                    grid.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        } else {
            icon.style.display = 'block';
            text.style.display = 'block';
        }
    }
</script>
@endsection