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
        <form action="{{ route('pemeliharaan.update', $pemeliharaan->pemeliharaan_id) }}" method="POST">
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
                <textarea name="tindakan" class="form-control border-2" style="border-radius: 12px;" rows="4" required>{{ $pemeliharaan->tindakan }}</textarea>
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

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 12px;">Batal</a>
                <button type="submit" class="btn btn-primary px-4 py-2" style="background: #1b3c53; border-radius: 12px;">Perbarui Log</button>
            </div>
        </form>
    </div>
</div>
@endsection