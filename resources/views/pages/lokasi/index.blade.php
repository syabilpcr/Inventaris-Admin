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

    /* Foto Style */
    .img-loc-container {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e9e1d9;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .img-loc-container:hover {
        transform: scale(1.1);
        border-color: #456882;
    }

    .img-loc-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image-placeholder {
        width: 60px;
        height: 60px;
        background: #f8f9fa;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d2c1b6;
        border: 2px dashed #e9e1d9;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
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
    }

    .btn-delete:hover {
        background: #c0392b;
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
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Manajemen Lokasi Aset</h2>
            <p class="mb-0 opacity-75">Pantau dan kelola titik penempatan aset Anda</p>
        </div>
        <i class="bi bi-geo-alt" style="font-size: 55px; opacity: .85;"></i>
    </div>

    {{-- STATS SECTION --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card-soft border-start border-primary border-4 py-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-light p-3 me-3"><i class="bi bi-pin-map fs-3 text-primary"></i></div>
                    <div>
                        <h6 class="text-muted mb-1">Total Titik Lokasi</h6>
                        <h4 class="fw-bold mb-0">{{ $locations->count() }} Lokasi</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-soft border-start border-info border-4 py-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-light p-3 me-3"><i class="bi bi-box-seam fs-3 text-info"></i></div>
                    <div>
                        <h6 class="text-muted mb-1">Aset Terdaftar</h6>
                        <h4 class="fw-bold mb-0">{{ $locations->unique('aset_id')->count() }} Item</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="card-soft">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">Daftar Penempatan</h4>
            <a href="{{ route('lokasi-aset.create') }}" class="btn btn-primary-custom shadow-sm">
                <i class="bi bi-plus-circle me-2"></i> Tambah Lokasi
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px">NO</th>
                        <th style="width: 100px">Foto</th>
                        <th>Aset</th>
                        <th>Titik Lokasi</th>
                        <th>RT/RW</th>
                        <th>Keterangan</th>
                        <th class="text-center" style="width: 120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $index => $item)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                        <td>
                            @php
                            $photo = $item->media->where('ref_table', 'lokasi_aset')->first();
                            @endphp

                            @if($photo)
                            <div class="img-loc-container" data-bs-toggle="modal" data-bs-target="#modalImg{{ $item->lokasi_id }}">
                                <img src="{{ asset('storage/' . $photo->file_name) }}" alt="Foto Lokasi">
                            </div>

                            <div class="modal fade" id="modalImg{{ $item->lokasi_id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 bg-transparent">
                                        <div class="modal-body p-0 text-center">
                                            <img src="{{ asset('storage/' . $photo->file_name) }}" class="img-fluid rounded shadow-lg">
                                            <button type="button" class="btn btn-light mt-3 rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="no-image-placeholder">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold" style="color: #1b3c53;">{{ $item->aset->nama_aset ?? 'N/A' }}</div>
                            <span class="badge bg-light text-dark border">{{ $item->aset->kode_aset ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <span class="fw-medium">{{ $item->lokasi_text }}</span>
                            </div>
                        </td>
                        <td><span class="badge-rtrw">RT {{ $item->rt ?? '00' }} / RW {{ $item->rw ?? '00' }}</span></td>
                        <td><small class="text-muted">{{ Str::limit($item->keterangan, 40) ?? '-' }}</small></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('lokasi-aset.edit', $item->lokasi_id) }}" class="btn-edit shadow-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('lokasi-aset.destroy', $item->lokasi_id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete btn-confirm-delete shadow-sm"
                                        data-name="{{ $item->lokasi_text }}" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-map text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-3 text-muted">Data penempatan lokasi belum ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi Hapus
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const name = this.getAttribute('data-name');
                if (!confirm(`Apakah Anda yakin ingin menghapus lokasi "${name}"?`)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

@endsection