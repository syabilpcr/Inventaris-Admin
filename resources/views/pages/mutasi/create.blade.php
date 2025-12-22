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
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Catat Mutasi Baru</h2>
            <p class="mb-0 opacity-75">Input data perpindahan atau perubahan status aset</p>
        </div>
        <div>
            <i class="bi bi-arrow-left-right" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="card-soft">
        <form action="{{ route('mutasi.store') }}" method="POST">
            @csrf

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    {{-- SEKSI PILIH ASET --}}
                    <div class="form-section">
                        <h5><i class="bi bi-box-seam me-2"></i>Identitas Mutasi</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Pilih Aset</label>
                                <select name="aset_id" class="form-control form-control-custom" required>
                                    <option value="">-- Pilih Aset --</option>
                                    @foreach($assets as $a)
                                    <option value="{{ $a->aset_id }}" {{ old('aset_id') == $a->aset_id ? 'selected' : '' }}>
                                        {{ $a->kode_aset }} - {{ $a->nama_aset }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Tanggal Mutasi</label>
                                <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- SEKSI DETAIL MUTASI --}}
                    <div class="form-section">
                        <h5><i class="bi bi-info-circle me-2"></i>Detail Perubahan</h5>
                        <div class="mb-3">
                            <label class="form-label-custom required-field">Jenis Mutasi</label>
                            <select name="jenis_mutasi" class="form-control form-control-custom" required>
                                <option value="Penempatan Baru" {{ old('jenis_mutasi') == 'Penempatan Baru' ? 'selected' : '' }}>Penempatan Baru</option>
                                <option value="Pemindahan" {{ old('jenis_mutasi') == 'Pemindahan' ? 'selected' : '' }}>Pemindahan (Rotasi)</option>
                                <option value="Perbaikan" {{ old('jenis_mutasi') == 'Perbaikan' ? 'selected' : '' }}>Keluar (Perbaikan)</option>
                                <option value="Hibah" {{ old('jenis_mutasi') == 'Hibah' ? 'selected' : '' }}>Hibah/Pemberian</option>
                                <option value="Penghapusan" {{ old('jenis_mutasi') == 'Penghapusan' ? 'selected' : '' }}>Penghapusan Aset</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Keterangan / Alasan</label>
                            <textarea name="keterangan" class="form-control form-control-custom" rows="4" placeholder="Contoh: Dipindahkan dari Gedung A ke Gedung B karena renovasi ruangan">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('mutasi.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Simpan Mutasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection