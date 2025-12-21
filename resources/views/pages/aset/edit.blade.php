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

    label {
        font-weight: 600;
        color: #1b3c53;
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

    .preview-img {
        width: 160px;
        height: auto;
        border-radius: 12px;
        border: 2px solid #d2c1b6;
        margin-top: 10px;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold" style="color:#1b3c53;">
            <i class="bi bi-pencil-square me-2"></i>Edit Aset
        </h2>
        <small style="color:#456882;">Perbarui data aset</small>
    </div>

    <div class="card-soft">

        <form action="{{ route('aset.update', $aset->aset_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- KATEGORI --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom required-field">Kategori Aset</label>
                    <select name="kategori_id" class="form-control form-control-custom" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $k)
                        <option value="{{ $k->kategori_id }}"
                            {{ old('kategori_id', $aset->kategori_id) == $k->kategori_id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>

                    @error('kategori_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KODE ASET --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom required-field">Kode Aset</label>
                    <input type="text"
                        name="kode_aset"
                        class="form-control form-control-custom"
                        value="{{ old('kode_aset', $aset->kode_aset) }}"
                        required>

                    @error('kode_aset')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NAMA ASET --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom required-field">Nama Aset</label>
                    <input type="text"
                        name="nama_aset"
                        class="form-control form-control-custom"
                        value="{{ old('nama_aset', $aset->nama_aset) }}"
                        required>

                    @error('nama_aset')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL PEROLEHAN --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom required-field">Tanggal Perolehan</label>
                    <input type="date"
                        name="tgl_perolehan"
                        class="form-control form-control-custom"
                        value="{{ old('tgl_perolehan', \Carbon\Carbon::parse($aset->tgl_perolehan)->format('Y-m-d')) }}"
                        required>

                    @error('tgl_perolehan')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NILAI PEROLEHAN --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom required-field">Nilai Perolehan</label>
                    <input type="number"
                        name="nilai_perolehan"
                        class="form-control form-control-custom"
                        value="{{ old('nilai_perolehan', $aset->nilai_perolehan) }}"
                        required>

                    @error('nilai_perolehan')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KONDISI --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom required-field">Kondisi Aset</label>
                    <select name="kondisi" class="form-control form-control-custom" required>
                        <option value="">Pilih Kondisi</option>
                        @foreach (['Sangat Baik','Baik','Rusak Ringan','Rusak Berat'] as $kondisi)
                        <option value="{{ $kondisi }}"
                            {{ old('kondisi', $aset->kondisi) == $kondisi ? 'selected' : '' }}>
                            {{ $kondisi }}
                        </option>
                        @endforeach
                    </select>

                    @error('kondisi')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-save me-1"></i> Update Aset
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
</script>

@endsection