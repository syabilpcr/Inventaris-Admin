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
        padding: 25px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9e1d9;
    }

    .table th {
        background: linear-gradient(135deg, #1b3c53, #456882) !important;
        color: white;
        vertical-align: middle;
        border: none;
        padding: 16px 12px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .table td {
        vertical-align: middle;
        background: white;
        padding: 14px 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #456882, #1b3c53);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(69, 104, 130, 0.3);
        color: white;
    }

    .btn-edit {
        background: #d2c1b6;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        color: #1b3c53;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-edit:hover {
        background: #456882;
        color: white;
    }

    .btn-delete {
        background: #e74c3c;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        color: white;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete:hover {
        background: #c0392b;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #456882;
    }

    .info-section h5 {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .badge-mutasi {
        background: rgba(210, 193, 182, 0.3);
        color: #1b3c53;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9e1d9;
    }

    .alert-custom {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Riwayat Mutasi Aset</h2>
            <p class="mb-0 opacity-75">Pantau perpindahan lokasi dan perubahan status aset</p>
        </div>
        <div>
            <i class="bi bi-arrow-left-right" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-journal-text me-2" style="color: #456882;"></i>Log Mutasi
            </h2>
            <small style="color: #456882;">Daftar kronologis mutasi aset</small>
        </div>
    </div>

    {{-- STATISTIC SECTION --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="info-section">
                <h5><i class="bi bi-clock-history me-2"></i>Total Mutasi</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #1b3c53;">{{ $mutasi->count() }} Transaksi</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-section">
                <h5><i class="bi bi-calendar-event me-2"></i>Mutasi Bulan Ini</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #456882;">
                    {{ $mutasi->where('tanggal', '>=', now()->startOfMonth())->count() }} Transaksi
                </p>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-task me-2"></i> Daftar Mutasi
            </h4>

            <a href="{{ route('mutasi.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-1"></i> Catat Mutasi Baru
            </a>
        </div>

        @if(session('success'))
        <div class="alert-custom">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px">NO</th>
                        <th>TANGGAL</th>
                        <th>INFO ASET</th>
                        <th>JENIS MUTASI</th>
                        <th>KETERANGAN</th>
                        <th style="width: 120px" class="text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @if($mutasi->count() > 0)
                        @foreach ($mutasi as $index => $m)
                        <tr>
                            <td class="fw-bold" style="color: #1b3c53;">{{ $index + 1 }}</td>
                            <td style="color: #456882; font-weight: 500;">
                                {{ \Carbon\Carbon::parse($m->tanggal)->format('d M Y') }}
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #1b3c53;">{{ $m->aset->nama_aset }}</div>
                                <small class="text-muted">{{ $m->aset->kode_aset }}</small>
                            </td>
                            <td>
                                <span class="badge-mutasi">
                                    {{ $m->jenis_mutasi }}
                                </span>
                            </td>
                            <td style="color: #456882; font-style: italic;">
                                {{ $m->keterangan ?? '-' }}
                            </td>
                            <td>
                                <div class="action-buttons justify-content-center">
                                    <a href="{{ route('mutasi.edit', $m->mutasi_id) }}" class="btn-edit" title="Edit Mutasi">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('mutasi.destroy', $m->mutasi_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus Mutasi"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data mutasi ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-arrow-left-right" style="font-size: 3rem; color: #d2c1b6; margin-bottom: 1rem;"></i>
                                    <h5 style="color: #1b3c53;">Belum Ada Data Mutasi</h5>
                                    <p class="text-muted">Riwayat perpindahan aset akan muncul di sini</p>
                                    <a href="{{ route('mutasi.create') }}" class="btn btn-primary-custom mt-2">
                                        <i class="bi bi-plus-circle me-1"></i> Mulai Mutasi
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection