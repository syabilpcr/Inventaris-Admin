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

    .info-section p {
        color: #456882;
        margin-bottom: 0;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .badge-rtrw {
        background: rgba(27, 60, 83, 0.1);
        color: #1b3c53;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid rgba(27, 60, 83, 0.2);
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
            <h2 class="fw-bold mb-2">Manajemen Lokasi Aset</h2>
            <p class="mb-0 opacity-75">Pantau dan kelola titik penempatan aset Anda</p>
        </div>
        <div>
            <i class="bi bi-geo-alt" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    {{-- STATS SECTION --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="info-section">
                <h5><i class="bi bi-pin-map me-2"></i>Total Titik Lokasi</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #1b3c53;">{{ $locations->count() }} Lokasi</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-section" style="border-left-color: #d2c1b6;">
                <h5><i class="bi bi-box-seam me-2"></i>Aset Terlokalisasi</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #456882;">{{ $locations->unique('aset_id')->count() }} Item Aset</p>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-stars me-2"></i> Daftar Penempatan Lokasi
            </h4>

            <a href="{{ route('lokasi-aset.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi
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
                        <th style="width: 50px">NO</th>
                        <th>Nama Aset</th>
                        <th>Lokasi (Titik)</th>
                        <th>RT/RW</th>
                        <th>Keterangan</th>
                        <th style="width: 120px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if($locations->count() > 0)
                    @foreach ($locations as $index => $item)
                    <tr>
                        <td class="fw-bold" style="color: #1b3c53;">{{ $index + 1 }}</td>
                        <td>
                            <div style="color: #1b3c53; font-weight: 600;">{{ $item->aset->nama_aset ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $item->aset->kode_aset ?? '-' }}</small>
                        </td>
                        <td style="color: #456882; font-weight: 500;">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $item->lokasi_text }}
                        </td>
                        <td>
                            <span class="badge-rtrw">RT {{ $item->rt ?? '00' }} / RW {{ $item->rw ?? '00' }}</span>
                        </td>
                        <td class="text-muted small">
                            {{ Str::limit($item->keterangan, 50) ?? '-' }}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('lokasi-aset.edit', $item->lokasi_id) }}" class="btn-edit" title="Edit Lokasi">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('lokasi-aset.destroy', $item->lokasi_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete btn-confirm-delete" title="Hapus Lokasi"
                                        data-name="{{ $item->lokasi_text }}">
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
                                <i class="bi bi-map" style="font-size: 3rem; color: #d2c1b6; margin-bottom: 1rem;"></i>
                                <h5 style="color: #1b3c53;">Data Lokasi Belum Tersedia</h5>
                                <p class="text-muted">Tentukan lokasi penempatan untuk aset-aset Anda</p>
                                <a href="{{ route('lokasi-aset.create') }}" class="btn btn-primary-custom mt-2">
                                    <i class="bi bi-plus-circle me-1"></i> Input Lokasi Pertama
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi hapus yang lebih spesifik
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const locationName = this.getAttribute('data-name');
                if (!confirm(`Hapus data lokasi "${locationName}"?`)) {
                    e.preventDefault();
                }
            });
        });

        // Inisialisasi Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection