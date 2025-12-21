@extends('layouts.admin.app')

@section('content')
<style>
    body {
        background: #f9f3ef !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header-custom {
        background: linear-gradient(135deg, #d2c1b6, #456882);
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
        border-left: 4px solid #d2c1b6;
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
            <h2 class="fw-bold mb-2">Edit Lokasi Aset</h2>
            <p class="mb-0 opacity-75">Perbarui informasi penempatan aset Anda</p>
        </div>
        <div>
            <i class="bi bi-pencil-square" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">

        @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('lokasi-aset.update', $lokasi->lokasi_id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- PEMILIHAN ASET --}}
            <div class="form-section">
                <h5><i class="bi bi-box-seam me-2"></i>Informasi Aset</h5>
                <div class="mb-3">
                    <label class="form-label-custom required-field">Aset yang Ditempatkan</label>
                    <select name="aset_id" class="form-control form-control-custom" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach ($assets as $a)
                        <option value="{{ $a->aset_id }}" {{ (old('aset_id', $lokasi->aset_id) == $a->aset_id) ? 'selected' : '' }}>
                            {{ $a->kode_aset }} - {{ $a->nama_aset }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- DETAIL LOKASI --}}
            <div class="form-section">
                <h5><i class="bi bi-geo-alt me-2"></i>Detail Lokasi Baru</h5>

                <div class="mb-3">
                    <label class="form-label-custom required-field">Nama Lokasi / Ruangan</label>
                    <input type="text" name="lokasi_text"
                        class="form-control form-control-custom"
                        value="{{ old('lokasi_text', $lokasi->lokasi_text) }}"
                        placeholder="Contoh: Gedung A, Ruang Meeting 01" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-custom">RT</label>
                        <input type="text" name="rt"
                            class="form-control form-control-custom"
                            value="{{ old('rt', $lokasi->rt) }}"
                            placeholder="000" maxlength="5">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label-custom">RW</label>
                        <input type="text" name="rw"
                            class="form-control form-control-custom"
                            value="{{ old('rw', $lokasi->rw) }}"
                            placeholder="000" maxlength="5">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control form-control-custom"
                        rows="3" placeholder="Masukkan detail tambahan...">{{ old('keterangan', $lokasi->keterangan) }}</textarea>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('lokasi-aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>

                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-save me-2"></i> Perbarui Data Lokasi
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Memastikan input RT/RW hanya angka
    document.querySelectorAll('input[name="rt"], input[name="rw"]').forEach(input => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
</script>

@endsection