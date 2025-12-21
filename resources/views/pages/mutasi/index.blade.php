@extends('layouts.admin.app')

@section('content')
<style>
    body {
        background: #f9f3ef !important;
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

    .badge-mutasi {
        background: #d2c1b6;
        color: #1b3c53;
        font-weight: 600;
        padding: 6px 15px;
        border-radius: 10px;
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid px-4">
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Mutasi Aset</h2>
            <p class="mb-0 opacity-75">Pantau perpindahan dan perubahan status aset</p>
        </div>
        <a href="{{ route('mutasi.create') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold text-primary">
            <i class="bi bi-arrow-left-right me-2"></i>Catat Mutasi
        </a>
    </div>

    <div class="card-soft">
        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px">NO</th>
                        <th>Tanggal</th>
                        <th>Aset</th>
                        <th>Jenis Mutasi</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1; @endphp
                    @foreach($mutasi as $m)
                    <tr>
                        <td class="fw-bold" style="color: #1b3c53;">{{ $counter }}</td>
                        <td>{{ \Carbon\Carbon::parse($m->tanggal)->format('d M Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $m->aset->nama_aset }}</div>
                            <small class="text-muted">{{ $m->aset->kode_aset }}</small>
                        </td>
                        <td><span class="badge-mutasi">{{ $m->jenis_mutasi }}</span></td>
                        <td>{{ $m->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('mutasi.edit', $m->mutasi_id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('mutasi.destroy', $m->mutasi_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus data mutasi ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection