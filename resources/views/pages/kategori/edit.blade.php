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

    .form-control-custom {
        border: 2px solid #d2c1b6;
        border-radius: 10px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: #456882;
        box-shadow: none;
        background: #fff;
    }

    .form-control-custom:read-only {
        background-color: #f1f1f1;
        cursor: not-allowed;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #456882, #1b3c53);
        transform: translateY(-2px);
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
        transition: 0.3s;
    }

    .btn-secondary-custom:hover {
        background: #c4b0a3;
        transform: translateY(-2px);
        color: #1b3c53;
    }
</style>

<div class="container-fluid px-4">
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold" style="color:#1b3c53;">
            <i class="bi bi-pencil-square me-2"></i>Edit Kategori Aset
        </h2>
        <small style="color:#456882;">Perbarui informasi kategori untuk pengorganisiran aset yang lebih baik</small>
    </div>

    <div class="card-soft">
        <form action="{{ route('kategori-aset.update', $kategori->kategori_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="form-section">
                        <h5><i class="bi bi-tag me-2"></i>Informasi Kategori</h5>
                        
                        <div class="row">
                            {{-- Nama Kategori --}}
                            <div class="col-md-8 mb-3">
                                <label class="mb-2 fw-semibold" style="color: #1b3c53;">Nama Kategori</label>
                                <input type="text" 
                                       name="nama" 
                                       class="form-control form-control-custom shadow-none @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama', $kategori->nama) }}" 
                                       placeholder="Contoh: Elektronik / Furnitur"
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kode Kategori --}}
                            <div class="col-md-4 mb-3">
                                <label class="mb-2 fw-semibold" style="color: #1b3c53;">Kode Kategori</label>
                                <input type="text" 
                                       name="kode" 
                                       class="form-control form-control-custom shadow-none" 
                                       value="{{ $kategori->kode }}" 
                                       readonly>
                                <small class="text-muted" style="font-size: 0.75rem;">* Kode tidak dapat diubah</small>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-md-12 mb-3">
                                <label class="mb-2 fw-semibold" style="color: #1b3c53;">Deskripsi</label>
                                <textarea name="deskripsi" 
                                          class="form-control form-control-custom shadow-none" 
                                          rows="5" 
                                          placeholder="Masukkan penjelasan singkat mengenai kategori ini">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('kategori-aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection