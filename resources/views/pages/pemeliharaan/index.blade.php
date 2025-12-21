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

    .table-custom thead {
        background: #fefcfb;
        color: #1b3c53;
    }

    .badge-price {
        background: #e9e1d9;
        color: #1b3c53;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 8px;
    }
</style>

<div class="container-fluid px-4">
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Riwayat Pemeliharaan</h2>
            <p class="mb-0 opacity-75">Kelola log perawatan dan perbaikan aset</p>
        </div>
        <a href="{{ route('pemeliharaan.create') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold text-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Log
        </a>
    </div>

    <div class="card-soft">
        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle table-custom">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Aset</th>
                        <th>Tindakan</th>
                        <th>Biaya</th>
                        <th>Pelaksana</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemeliharaan as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $p->aset->nama_aset }}</div>
                            <small class="text-muted">{{ $p->aset->kode_aset }}</small>
                        </td>
                        <td>{{ Str::limit($p->tindakan, 50) }}</td>
                        <td><span class="badge-price">Rp {{ number_format($p->biaya, 0, ',', '.') }}</span></td>
                        <td>{{ $p->pelaksana }}</td>
                        <td class="text-center">
                            <a href="{{ route('pemeliharaan.edit', $p->pemeliharaan_id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('pemeliharaan.destroy', $p->pemeliharaan_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus log ini?')"><i class="bi bi-trash"></i></button>
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