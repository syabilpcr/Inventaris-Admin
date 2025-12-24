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
            <h2 class="fw-bold mb-2">Manajemen Kategori Aset</h2>
            <p class="mb-0 opacity-75">Kelola pengelompokan aset agar lebih terorganisir</p>
        </div>
        <div>
            <i class="bi bi-tags" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-ul me-2" style="color: #456882;"></i>Daftar Kategori
            </h2>
            <small style="color: #456882;">Kelola semua klasifikasi aset dalam sistem</small>
        </div>
    </div>

    {{-- STATISTIC SECTION (Sama dengan Data Aset) --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="info-section">
                <h5><i class="bi bi-grid me-2"></i>Total Kategori</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #1b3c53;">{{ $kategoris->count() }} Item</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section">
                <h5><i class="bi bi-calendar-check me-2"></i>Update Terakhir</h5>
                <p class="fw-bold fs-6 mb-0" style="color: #27ae60;">
                    {{ $kategoris->count() > 0 ? $kategoris->max('updated_at')->format('d M Y') : '-' }}
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section">
                <h5><i class="bi bi-info-circle me-2"></i>Status Sistem</h5>
                <p class="fw-bold fs-6 mb-0" style="color: #1b3c53;">Aktif & Terorganisir</p>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-task me-2"></i> Data Klasifikasi
            </h4>

            <a href="{{ route('kategori-aset.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
            </a>
        </div>

        {{-- Success/Error Alert --}}
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
                        <th>KODE</th>
                        <th>NAMA KATEGORI</th>
                        <th>DESKRIPSI</th>
                        <th>TERAKHIR DIUBAH</th>
                        <th style="width: 120px">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @if($kategoris->count() > 0)
                    @foreach ($kategoris as $kategori)
                    <tr>
                        <td class="fw-bold" style="color: #1b3c53;">{{ $loop->iteration }}</td>
                        <td>
                            <span class="kategori-badge">
                                {{ strtoupper($kategori->kode) }}
                            </span>
                        </td>
                        <td style="color: #1b3c53; font-weight: 500;">{{ $kategori->nama }}</td>
                        <td style="color: #456882;">{{ $kategori->deskripsi ?? '-' }}</td>
                        <td style="color: #456882;">
                            <small><i class="bi bi-clock me-1"></i>{{ $kategori->updated_at->format('d M Y, H:i') }}</small>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('kategori-aset.edit', $kategori->kategori_id) }}" class="btn-edit" title="Edit Kategori">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('kategori-aset.destroy', $kategori->kategori_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete btn-delete-trigger" title="Hapus Kategori" data-name="{{ $kategori->nama }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-tag" style="font-size: 3rem; color: #d2c1b6; margin-bottom: 1rem;"></i>
                                <h5 style="color: #1b3c53;">Belum Ada Kategori</h5>
                                <p class="text-muted">Klasifikasikan aset Anda sekarang</p>
                                <a href="{{ route('kategori-aset.create') }}" class="btn btn-primary-custom mt-2">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Kategori Pertama
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

{{-- SweetAlert2 Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi Hapus Menggunakan SweetAlert2
        const deleteButtons = document.querySelectorAll('.btn-delete-trigger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Kategori "${name}" akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b3c53',
                    cancelButtonColor: '#e74c3c',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    borderRadius: '15px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
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