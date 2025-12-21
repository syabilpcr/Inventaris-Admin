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
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
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

    .asset-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #d2c1b6;
    }

    .asset-img-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        border: 2px solid #d2c1b6;
        background: #f9f3ef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d2c1b6;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-left: 4px solid #456882;
    }

    .info-section h5 {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .info-section p {
        color: #456882;
        margin-bottom: 0;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .badge-kondisi {
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

    .kategori-badge {
        background: rgba(210, 193, 182, 0.2);
        color: #1b3c53;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
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
            <h2 class="fw-bold mb-2">Manajemen Data Aset</h2>
            <p class="mb-0 opacity-75">Kelola dan organisasi aset dengan mudah</p>
        </div>
        <div>
            <i class="bi bi-box-seam" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

     <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate-header">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-ul me-2" style="color: #456882;"></i>Daftar Data
            </h2>
            <small style="color: #456882;">Kelola semua data aset dalam sistem</small>
        </div>
    </div>

    {{-- DATA ASET SECTION --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="info-section">
                <h5><i class="bi bi-box me-2"></i>Total Aset</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #1b3c53;">{{ $aset->count() }} Item</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section">
                <h5><i class="bi bi-check-circle me-2"></i>Aset Baik</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #27ae60;">{{ $aset->where('kondisi', 'baik')->count() }} Item</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section">
                <h5><i class="bi bi-exclamation-triangle me-2"></i>Perlu Perbaikan</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #e67e22;">{{ $aset->whereIn('kondisi', ['rusak_ringan', 'rusak_berat'])->count() }} Item</p>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-task me-2"></i> Daftar Aset
            </h4>

            <a href="{{ route('aset.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-1"></i> Tambah Aset
            </a>
        </div>

        @if(session('success'))
            <div class="alert-custom">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Kategori</th>
                        <th>Tanggal Perolehan</th>
                        <th>Nilai Perolehan</th>
                        <th>Kondisi</th>
                        <th style="width: 120px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $counter = 1; @endphp
                    @if($aset->count() > 0)
                        @foreach ($aset as $item)
                        <tr>
                            <td class="fw-bold" style="color: #1b3c53;">{{ $counter++ }}</td>
                            <td style="color: #456882; font-weight: 600;">{{ $item->kode_aset }}</td>
                            <td style="color: #1b3c53; font-weight: 500;">{{ $item->nama_aset }}</td>
                            <td>
                                @if($item->kategori)
                                    <span class="kategori-badge">
                                        {{ $item->kategori->nama }}
                                    </span>
                                @else
                                    <span class="kategori-badge" style="background: #f8d7da; color: #721c24;">
                                        Kategori Dihapus
                                    </span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_perolehan)->format('d M Y') }}</td>
                            <td style="color: #1b3c53; font-weight: 600;">Rp {{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $badgeClass = 'bg-secondary';
                                    $kondisiText = 'Tidak Diketahui';
                                    
                                    switch($item->kondisi) {
                                        case 'Sangat Baik':
                                            $badgeClass = 'bg-success';
                                            $kondisiText = 'Sangat Baik';
                                            break;
                                        case 'Baik':
                                            $badgeClass = 'bg-warning text-dark';
                                            $kondisiText = 'Baik';
                                            break;
                                        case 'Rusak Ringan':
                                            $badgeClass = 'bg-danger';
                                            $kondisiText = 'Rusak Ringan';
                                            break;
                                        case 'Rusak Berat':
                                            $badgeClass = 'bg-info';
                                            $kondisiText = 'Rusak Berat';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }} badge-kondisi">
                                    {{ $kondisiText }}
                                </span>
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('aset.edit', $item->aset_id) }}" class="btn-edit" title="Edit Aset">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('aset.destroy', $item->aset_id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus Aset" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus aset {{ $item->nama_aset }}?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #d2c1b6; margin-bottom: 1rem;"></i>
                                    <h5 style="color: #1b3c53;">Belum Ada Data Aset</h5>
                                    <p class="text-muted">Silakan tambah aset pertama Anda</p>
                                    <a href="{{ route('aset.create') }}" class="btn btn-primary-custom mt-2">
                                        <i class="bi bi-plus-circle me-1"></i> Tambah Aset Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- PAGINATION DISINI -->
    </div>
</div>

<script>
// Konfirmasi sebelum menghapus
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const assetName = this.closest('tr').querySelector('td:nth-child(4)').textContent;
            if (!confirm(`Apakah Anda yakin ingin menghapus aset "${assetName}"? Tindakan ini tidak dapat dibatalkan.`)) {
                e.preventDefault();
            }
        });
    });
});

// Tooltip untuk aksi
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>

@endsection