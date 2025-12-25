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

    .asset-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #d2c1b6;
        cursor: pointer;
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
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        background: rgba(210, 193, 182, 0.3);
        color: #1b3c53;
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9e1d9;
    }

    .kategori-badge {
        background: rgba(27, 60, 83, 0.1);
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
            <h2 class="fw-bold mb-2">Manajemen Lokasi Aset</h2>
            <p class="mb-0 opacity-75">Pantau dan kelola titik penempatan aset Anda</p>
        </div>
        <div>
            <i class="bi bi-geo-alt" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-ul me-2" style="color: #456882;"></i>Daftar Penempatan
            </h2>
            <small style="color: #456882;">Kelola semua koordinat dan lokasi aset</small>
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
            <div class="info-section" style="border-left-color: #27ae60;">
                <h5><i class="bi bi-box-seam me-2"></i>Aset Terdaftar</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #27ae60;">{{ $locations->unique('aset_id')->count() }} Item</p>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-geo-fill me-2"></i> Detail Penempatan
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

        <form method="GET" action="{{ route('lokasi-aset.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-2">
                    <select name="rt" class="form-select" onchange="this.form.submit()" style="border-radius: 10px;">
                        <option value="">Semua RT</option>
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ sprintf('%02d', $i) }}" {{ request('rt') == sprintf('%02d', $i) ? 'selected' : '' }}>RT {{ sprintf('%02d', $i) }}</option>
                            @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="rw" class="form-select" onchange="this.form.submit()" style="border-radius: 10px;">
                        <option value="">Semua RW</option>
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ sprintf('%02d', $i) }}" {{ request('rw') == sprintf('%02d', $i) ? 'selected' : '' }}>RW {{ sprintf('%02d', $i) }}</option>
                            @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari Nama Aset atau Alamat..." style="border-radius: 10px 0 0 10px;">
                        <button type="submit" class="btn btn-primary-custom" style="border-radius: 0 10px 10px 0;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('lokasi-aset.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px">NO</th>
                        <th style="width: 100px">FOTO</th>
                        <th>ASET</th>
                        <th>TITIK LOKASI</th>
                        <th>RT/RW</th>
                        <th>KETERANGAN</th>
                        <th style="width: 120px" class="text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($locations as $index => $item)
                    <tr>
                        <td class="text-center fw-bold" style="color: #1b3c53;">{{ $index + 1 }}</td>
                        {{-- KOLOM FOTO LOKASI --}}
                        <td>
                            @php
                            $photo = $item->media->where('ref_table', 'lokasi_aset')->first();
                            @endphp

                            @if($photo)
                            <img src="{{ asset('storage/' . $photo->file_name) }}"
                                class="asset-img"
                                alt="Foto Lokasi"
                                data-bs-toggle="modal"
                                data-bs-target="#imageModal{{ $item->lokasi_id }}">

                            {{-- Modal Zoom Image --}}
                            <div class="modal fade" id="imageModal{{ $item->lokasi_id }}" tabindex="-1" aria-hidden="true">
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
                            <div class="asset-img-placeholder">
                                <i class="bi bi-image" style="font-size: 1.5rem;"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold" style="color: #1b3c53;">{{ $item->aset->nama_aset ?? 'N/A' }}</div>
                            <span class="kategori-badge">{{ $item->aset->kode_aset ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center" style="color: #456882;">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <span class="fw-medium">{{ $item->lokasi_text }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge-rtrw">RT {{ $item->rt ?? '00' }} / RW {{ $item->rw ?? '00' }}</span>
                        </td>
                        <td style="color: #456882; font-size: 0.85rem;">
                            {{ Str::limit($item->keterangan, 40) ?? '-' }}
                        </td>
                        <td>
                            <div class="action-buttons justify-content-center">
                                <a href="{{ route('lokasi-aset.edit', $item->lokasi_id) }}" class="btn-edit" title="Edit Lokasi">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('lokasi-aset.destroy', $item->lokasi_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete btn-confirm-delete"
                                        data-name="{{ $item->lokasi_text }}" title="Hapus Lokasi">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-map" style="font-size: 3rem; color: #d2c1b6; margin-bottom: 1rem;"></i>
                                <h5 style="color: #1b3c53;">Belum Ada Data Lokasi</h5>
                                <p class="text-muted">Silakan tentukan titik penempatan aset Anda</p>
                                <a href="{{ route('lokasi-aset.create') }}" class="btn btn-primary-custom mt-2">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $locations->firstItem() }} sampai {{ $locations->lastItem() }} dari {{ $locations->total() }} data
                </div>
                <div>
                    {{ $locations->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi Hapus identik dengan view aset
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const name = this.getAttribute('data-name');
                if (!confirm(`Apakah Anda yakin ingin menghapus lokasi "${name}"? Tindakan ini tidak dapat dibatalkan.`)) {
                    e.preventDefault();
                }
            });
        });

        // Tooltip initialization
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection