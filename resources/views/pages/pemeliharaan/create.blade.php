@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-header-custom" style="background: linear-gradient(135deg, #1b3c53, #456882); border-radius: 20px; padding: 35px 40px; color: white; margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <h2 class="fw-bold mb-2">Tambah Log Pemeliharaan</h2>
            <p class="mb-0 opacity-75">Catat aktivitas perawatan aset secara detail</p>
        </div>
        <i class="bi bi-tools" style="font-size: 55px; opacity: .85;"></i>
    </div>

    <div class="card-soft" style="background: white; border-radius: 18px; padding: 30px; border: 1px solid #e9e1d9;">
        {{-- TAMBAHKAN enctype UNTUK UPLOAD FILE --}}
        <form action="{{ route('pemeliharaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Pilih Aset</label>
                    <select name="aset_id" class="form-select border-2 @error('aset_id') is-invalid @enderror" style="border-radius: 12px; padding: 12px;" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach($assets as $a)
                        <option value="{{ $a->aset_id }}" {{ old('aset_id') == $a->aset_id ? 'selected' : '' }}>
                            {{ $a->kode_aset }} - {{ $a->nama_aset }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Pemeliharaan</label>
                    <input type="date" name="tanggal" class="form-control border-2" style="border-radius: 12px; padding: 12px;" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tindakan / Perbaikan</label>
                <textarea name="tindakan" class="form-control border-2" style="border-radius: 12px;" rows="3" placeholder="Jelaskan apa yang diperbaiki..." required>{{ old('tindakan') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Biaya (Rp)</label>
                    <input type="number" name="biaya" class="form-control border-2" style="border-radius: 12px; padding: 12px;" placeholder="0" value="{{ old('biaya') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Pelaksana</label>
                    <input type="text" name="pelaksana" class="form-control border-2" style="border-radius: 12px; padding: 12px;" placeholder="Contoh: Teknisi / Nama Vendor" value="{{ old('pelaksana') }}" required>
                </div>
            </div>

            {{-- SEKSI UNGGAH FOTO --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Dokumentasi Foto (Bisa pilih banyak)</label>
                <div style="border: 2px dashed #d2c1b6; border-radius: 12px; padding: 20px; text-align: center; background: #fefcfb; cursor: pointer;" onclick="document.getElementById('foto_pemeliharaan').click()">
                    <i class="bi bi-camera-fill text-muted" style="font-size: 2rem;"></i>
                    <p class="mb-0 text-muted">Klik untuk memilih foto dokumentasi perbaikan</p>
                    <input type="file" name="foto_pemeliharaan[]" id="foto_pemeliharaan" class="d-none" multiple accept="image/*" onchange="previewImages(event)">
                </div>
                {{-- AREA PREVIEW --}}
                <div id="image-preview-grid" class="d-flex flex-wrap gap-2 mt-3"></div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 12px;">Batal</a>
                <button type="submit" class="btn btn-primary px-4 py-2" style="background: #1b3c53; border: none; border-radius: 12px;">
                    <i class="bi bi-save me-2"></i>Simpan Log
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT UNTUK PREVIEW GAMBAR --}}
<script>
    function previewImages(event) {
        const grid = document.getElementById('image-preview-grid');
        grid.innerHTML = '';
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.style.position = 'relative';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '10px';
                img.style.border = '2px solid #1b3c53';

                wrapper.appendChild(img);
                grid.appendChild(wrapper);
            }
            reader.readAsDataURL(files[i]);
        }
    }
</script>
@endsection