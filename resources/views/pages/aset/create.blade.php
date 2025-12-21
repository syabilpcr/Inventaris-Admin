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
    }

    .preview-container:hover {
        border-color: #456882;
        background: #f9f3ef;
    }

    .preview-image {
        max-width: 100%;
        max-height: 180px;
        border-radius: 10px;
        display: none;
    }

    .file-input-custom {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .file-input-custom input[type=file] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
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

    .help-text {
        color: #456882;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    .alert-custom {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }

    .alert-warning-custom {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Tambah Aset Baru</h2>
            <p class="mb-0 opacity-75">Tambahkan data aset baru ke dalam sistem</p>
        </div>
        <div>
            <i class="bi bi-plus-circle" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">
        {{-- TAMPILKAN PERINGATAN JIKA TIDAK ADA KATEGORI --}}
        @if(!isset($kategori) || $kategori->isEmpty())
        <div class="alert-warning-custom">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Peringatan:</strong> Tidak ada kategori aset yang tersedia.
            <a href="{{ route('kategori.create') }}" class="text-white text-decoration-underline">
                Tambahkan kategori terlebih dahulu.
            </a>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert-custom">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('aset.store') }}" method="POST">
            @csrf

            {{-- INFORMASI DASAR --}}
            <div class="form-section">
                <h5><i class="bi bi-info-circle me-2"></i>Informasi Dasar</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-custom required-field">Kategori Aset</label>
                        <select name="kategori_id" class="form-control form-control-custom" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                            <option value="{{ $k->kategori_id }}"
                                {{ old('kategori_id') == $k->kategori_id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label-custom required-field">Kode Aset</label>
                        <input type="text" name="kode_aset"
                            class="form-control form-control-custom"
                            value="{{ old('kode_aset') }}"
                            placeholder="Contoh: AST-001" required>

                        @error('kode_aset')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom required-field">Nama Aset</label>
                    <input type="text" name="nama_aset"
                        class="form-control form-control-custom"
                        value="{{ old('nama_aset') }}"
                        placeholder="Masukkan nama aset" required>

                    @error('nama_aset')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- NILAI & KONDISI --}}
            <div class="form-section">
                <h5><i class="bi bi-currency-dollar me-2"></i>Nilai & Kondisi</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label-custom required-field">Tanggal Perolehan</label>
                        <input type="date" name="tgl_perolehan"
                            class="form-control form-control-custom"
                            value="{{ old('tgl_perolehan', date('Y-m-d')) }}" required>

                        @error('tgl_perolehan')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label-custom required-field">Nilai Perolehan</label>
                        <input type="number" name="nilai_perolehan"
                            class="form-control form-control-custom"
                            value="{{ old('nilai_perolehan') }}"
                            placeholder="0" required>

                        @error('nilai_perolehan')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label-custom required-field">Kondisi Aset</label>
                        <select name="kondisi" class="form-control form-control-custom" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Sangat Baik" {{ old('kondisi') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>

                        @error('kondisi')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Simpan Aset
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('previewPlaceholder');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    }

    // Format input nilai perolehan
    document.querySelector('input[name="nilai_perolehan"]').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^\d]/g, '');
        if (value) {
            e.target.value = parseInt(value).toLocaleString('id-ID');
        }
    });

    // Set today's date as default for tanggal perolehan
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        const dateInput = document.querySelector('input[name="tgl_perolehan"]');

        if (!dateInput.value) {
            dateInput.value = today;
        }
    });
</script>

@endsection