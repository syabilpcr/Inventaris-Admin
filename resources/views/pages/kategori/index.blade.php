@extends('layouts.admin.app')

@section('title', 'Kategori Aset - Sistem Inventaris')

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

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9e1d9;
    }

    .kategori-badge {
        background: rgba(210, 193, 182, 0.2);
        color: #1b3c53;
        padding: 6px 14px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .animate-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header-custom animate-up">
        <div>
            <h2 class="fw-bold mb-2">Manajemen Kategori Aset</h2>
            <p class="mb-0 opacity-75">Kelola pengelompokan aset agar lebih terorganisir</p>
        </div>
        <div>
            <i class="bi bi-tags" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    {{-- STATISTICS SECTION --}}
    <div class="row mb-4 animate-up" style="animation-delay: 0.1s;">
        <div class="col-md-12">
            <div class="info-section d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-1"><i class="bi bi-grid me-2"></i>Total Kategori</h5>
                    <p class="text-muted mb-0">Jumlah klasifikasi aset saat ini</p>
                </div>
                <h2 class="fw-bold mb-0" style="color: #1b3c53;">{{ $kategoris->count() }} <span class="fs-5 fw-normal">Kategori</span></h2>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft animate-up" style="animation-delay: 0.2s;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-ul me-2"></i> Daftar Kategori
            </h4>
            <a href="{{ route('kategori-aset.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-2"></i> Tambah Kategori
            </a>
        </div>

        @if($kategoris->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr class="text-center">
                        <th width="50">NO</th>
                        <th>NAMA KATEGORI</th>
                        <th>KODE</th>
                        <th>DESKRIPSI</th>
                        <th>UPDATE TERAKHIR</th>
                        <th width="150">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                    <tr>
                        <td class="text-center fw-bold" style="color: #1b3c53;">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold" style="color: #1b3c53;">{{ strtoupper($kategori->nama) }}</div>
                        </td>
                        <td class="text-center">
                            <span class="kategori-badge">
                                {{ strtoupper($kategori->kode) }}
                            </span>
                        </td>
                        <td style="color: #456882; max-width: 300px;">
                            {{ $kategori->deskripsi ?? '-' }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex flex-column">
                                <small style="color: #1b3c53; font-weight: 500;">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $kategori->updated_at->translatedFormat('d M Y') }}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i> {{ $kategori->updated_at->format('H:i') }} WIB
                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('kategori-aset.edit', $kategori->kategori_id) }}" 
                                   class="btn-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('kategori-aset.destroy', $kategori->kategori_id) }}" 
                                      method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete btn-delete-trigger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-tag text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
            <h5 class="mt-3 text-muted">Belum ada kategori aset yang terdaftar.</h5>
            <a href="{{ route('kategori-aset.create') }}" class="btn btn-primary-custom mt-3">Buat Kategori Pertama</a>
        </div>
        @endif
    </div>
</div>

{{-- SweetAlert & Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Notifikasi Toast
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Konfirmasi Hapus
        document.querySelectorAll(".btn-delete-trigger").forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                const form = this.closest("form");
                
                Swal.fire({
                    title: 'Hapus Kategori?',
                    text: "Aset yang menggunakan kategori ini mungkin akan terpengaruh.",
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

        // Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection