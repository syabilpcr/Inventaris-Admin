@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-header-custom" style="background: linear-gradient(135deg, #456882, #1b3c53); border-radius: 20px; padding: 35px 40px; color: white; margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <h2 class="fw-bold mb-2">Edit Log Pemeliharaan</h2>
            <p class="mb-0 opacity-75">Perbarui informasi perawatan aset</p>
        </div>
        <i class="bi bi-pencil-square" style="font-size: 55px; opacity: .85;"></i>
    </div>

    <div class="card-soft" style="background: white; border-radius: 18px; padding: 30px; border: 1px solid #e9e1d9;">
        {{-- TAMBAHKAN enctype UNTUK UPLOAD FILE --}}
        <form action="{{ route('pemeliharaan.update', $pemeliharaan->pemeliharaan_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Aset</label>
                    <select name="aset_id" class="form-select border-2" style="border-radius: 12px; padding: 12px;" required>
                        @foreach($assets as $a)
                        <option value="{{ $a->aset_id }}" {{ $pemeliharaan->aset_id == $a->aset_id ? 'selected' : '' }}>
                            {{ $a->kode_aset }} - {{ $a->nama_aset }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control border-2" style="border-radius: 12px; padding: 12px;" value="{{ $pemeliharaan->tanggal }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tindakan</label>
                <textarea name="tindakan" class="form-control border-2" style="border-radius: 12px;" rows="3" required>{{ $pemeliharaan->tindakan }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Biaya (Rp)</label>
                    <input type="number" name="biaya" class="form-control border-2" style="border-radius: 12px; padding: 12px;" value="{{ (int)$pemeliharaan->biaya }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Pelaksana</label>
                    <input type="text" name="pelaksana" class="form-control border-2" style="border-radius: 12px; padding: 12px;" value="{{ $pemeliharaan->pelaksana }}" required>
                </div>
            </div>

            <hr class="my-4" style="border-top: 2px dashed #e9e1d9;">

            {{-- FOTO YANG SUDAH ADA --}}
            <div class="mb-4">
                <label class="form-label fw-bold d-block">Foto Dokumentasi Saat Ini</label>
                <div class="d-flex flex-wrap gap-3">
                    @forelse($pemeliharaan->media->where('ref_table', 'pemeliharaan') as $m)
                    <div class="position-relative" id="media-{{ $m->media_id }}">
                        <img src="{{ asset('storage/' . $m->file_name) }}"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 2px solid #e9e1d9;">
                        {{-- Opsional: Tombol hapus foto satuan jika Anda sudah membuat route-nya --}}
                        {{-- <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle" onclick="deleteMedia({{ $m->media_id }})">
                        <i class="bi bi-x"></i>
                        </button> --}}
                    </div>
                    @empty
                    <p class="text-muted small italic">Belum ada foto dokumentasi.</p>
                    @endforelse
                </div>
            </div>

            {{-- TAMBAH FOTO BARU --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Tambah Foto Dokumentasi Baru</label>
                <div style="border: 2px dashed #456882; border-radius: 12px; padding: 20px; text-align: center; background: #f8f9fa; cursor: pointer;" onclick="document.getElementById('foto_pemeliharaan').click()">
                    <i class="bi bi-plus-circle-dotted text-muted" style="font-size: 1.5rem;"></i>
                    <p class="mb-0 text-muted small">Klik untuk menambah foto dokumentasi baru</p>
                    <input type="file" name="foto_pemeliharaan[]" id="foto_pemeliharaan" class="d-none" multiple accept="image/*" onchange="previewImages(event)">
                </div>
                <div id="image-preview-grid" class="d-flex flex-wrap gap-2 mt-3"></div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 12px;">Batal</a>
                <button type="submit" class="btn btn-primary px-4 py-2" style="background: #1b3c53; border: none; border-radius: 12px;">
                    <i class="bi bi-check-all me-2"></i>Perbarui Log
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
                const wrapper = document.createElement('div');
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '80px';
                img.style.height = '80px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '8px';
                img.style.border = '2px solid #456882';

                wrapper.appendChild(img);
                grid.appendChild(wrapper);
            }
            reader.readAsDataURL(files[i]);
        }
    }
</script>
@endsection