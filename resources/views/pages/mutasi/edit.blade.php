@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-header-custom" style="background: linear-gradient(135deg, #456882, #1b3c53); border-radius: 20px; padding: 35px 40px; color: white; margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <h2 class="fw-bold mb-2">Edit Data Mutasi</h2>
            <p class="mb-0 opacity-75">Koreksi informasi mutasi aset</p>
        </div>
        <i class="bi bi-pencil-square" style="font-size: 55px; opacity: .85;"></i>
    </div>

    <div class="card-soft" style="background: white; border-radius: 18px; padding: 30px; border: 1px solid #e9e1d9;">
        <form action="{{ route('mutasi.update', $mutasi->mutasi_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Aset</label>
                    <select name="aset_id" class="form-select border-2" style="border-radius: 12px; padding: 12px;" required>
                        @foreach($assets as $a)
                        <option value="{{ $a->aset_id }}" {{ $mutasi->aset_id == $a->aset_id ? 'selected' : '' }}>
                            {{ $a->kode_aset }} - {{ $a->nama_aset }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control border-2" style="border-radius: 12px; padding: 12px;" value="{{ $mutasi->tanggal }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Mutasi</label>
                @php $options = ['Penempatan Baru', 'Pemindahan', 'Perbaikan', 'Hibah', 'Penghapusan']; @endphp
                <select name="jenis_mutasi" class="form-select border-2" style="border-radius: 12px; padding: 12px;" required>
                    @foreach($options as $opt)
                    <option value="{{ $opt }}" {{ $mutasi->jenis_mutasi == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan</label>
                <textarea name="keterangan" class="form-control border-2" style="border-radius: 12px;" rows="4">{{ $mutasi->keterangan }}</textarea>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('mutasi.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 12px;">Batal</a>
                <button type="submit" class="btn btn-primary px-4 py-2" style="background: #1b3c53; border-radius: 12px; border:none;">Update Mutasi</button>
            </div>
        </form>
    </div>
</div>
@endsection