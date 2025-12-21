@extends('layouts.admin.app')

@section('title', 'Kategori Aset - Sistem Inventaris')

@section('content')
<div class="container-fluid py-4 px-4 main-wrapper" style="background: #f9f3ef; min-height: 100vh;">

    {{-- Header Baru --}}
    <div class="row mb-5 animate-header">
        <div class="col-12">
            <div class="hero-section rounded-4 p-5 text-white position-relative overflow-hidden">
                <div class="hero-background"></div>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 fw-bold mb-3">Manajemen Kategori Aset</h1>
                        <p class="mb-0 opacity-75">Kelola dan organisasi kategori aset dengan mudah</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="hero-icon rounded-3 p-4 d-inline-block">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Header Asli --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate-header">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-ul me-2" style="color: #456882;"></i>Daftar Kategori
            </h2>
            <small style="color: #456882;">Kelola semua kategori aset dalam sistem</small>
        </div>
        <a href="{{ route('kategori-aset.create') }}" class="btn btn-add-category d-flex align-items-center gap-2 shadow-lg">
            <i class="bi bi-plus-circle-fill fs-5"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('
                success ') }}',
                timer: 2000,
                showConfirmButton: false,
                background: '#f9f3ef',
                color: '#456882',
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'animate__animated animate__fadeInDown rounded-4 shadow-lg border',
                    icon: 'text-success'
                }
            });
        });
    </script>
    @elseif (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('
                error ') }}',
                timer: 2200,
                showConfirmButton: false,
                background: '#f9f3ef',
                color: '#1b3c53',
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'animate__animated animate__fadeInDown rounded-4 shadow-lg border',
                    icon: 'text-danger'
                }
            });
        });
    </script>
    @endif

    {{-- Card Table --}}
    <div class="card-custom shadow-xl border-0 rounded-5 overflow-hidden fade-in">
        @if (isset($kategoris) && count($kategoris))
        <div class="table-responsive table-wrapper">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-header text-center">
                    <tr>
                        <th width="5%">NO</th>
                        <th>Nama Kategori</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Update</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                    <tr class="table-row animate__animated animate__fadeInUp" data-id="{{ $kategori->id }}">
                        <td class="text-center fw-semibold" style="color: #456882;">{{ $loop->iteration }}</td>
                        <td class="fw-semibold" style="color: #1b3c53;">{{ strtoupper($kategori->nama) }}</td>
                        <td class="text-center">
                            <span class="badge px-3 py-2 rounded-pill shadow-sm" style="background: rgba(27, 60, 83, 0.1); color: #1b3c53;">
                                {{ strtoupper($kategori->kode) }}
                            </span>
                        </td>
                        <td style="color: #456882;">{{ $kategori->deskripsi ?? '-' }}</td>
                        <td class="text-center" style="color: #456882;">
                            <div class="d-flex flex-column align-items-center">
                                <small class="text-muted mb-1">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $kategori->updated_at->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $kategori->updated_at->timezone('Asia/Jakarta')->translatedFormat('H:i') }}
                                </small>
                                @if($kategori->updated_at->gt($kategori->created_at))
                                <small class="text-success mt-1">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Diupdate
                                </small>
                                @else
                                <small class="text-muted mt-1">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Dibuat
                                </small>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('kategori-aset.edit', $kategori->kategori_id) }}"
                                    class="btn btn-sm btn-light shadow-sm border hover-scale"
                                    title="Edit Kategori" style="color: #456882; border-color: #d2c1b6!important;">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('kategori-aset.destroy', $kategori->kategori_id) }}" method="POST" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light shadow-sm border hover-scale btn-delete-trigger"
                                        title="Hapus Kategori" style="color: #1b3c53; border-color: #d2c1b6!important;">
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
        <div class="text-center py-5 fade-in">
            <i class="bi bi-inbox fs-1" style="color: #d2c1b6;"></i>
            <h5 class="mt-3 fw-bold" style="color: #1b3c53;">Belum Ada Kategori</h5>
            <p class="mb-3" style="color: #456882;">Tambahkan kategori untuk memulai</p>
            <a href="{{ route('kategori-aset.create') }}" class="btn btn-add-category">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Kategori
            </a>
        </div>
        @endif
    </div>
</div>

{{-- STYLE --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    :root {
        --primary-dark: #1b3c53;
        --primary-medium: #456882;
        --primary-light: #d2c1b6;
        --background: #f9f3ef;
    }

    body {
        background: var(--background);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-wrapper {
        padding: 1.5rem;
    }

    /* Hero Section Styles */
    .hero-section {
        box-shadow: 0 10px 30px rgba(27, 60, 83, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-background {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .hero-icon {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.2);
    }

    /* Card Styles */
    .card-custom {
        background: #fff;
        border-radius: 1.5rem;
        padding: 1.8rem;
        transition: all 0.4s ease;
        box-shadow: 0 5px 18px rgba(27, 60, 83, 0.08);
        border: 1px solid rgba(210, 193, 182, 0.3);
    }

    .card-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(27, 60, 83, 0.12);
    }

    /* Table Styles */
    .table-header {
        background: linear-gradient(90deg, rgba(210, 193, 182, 0.1), rgba(249, 243, 239, 0.3));
        font-weight: 600;
        color: var(--primary-dark);
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table th,
    .table td {
        padding: 14px 16px;
        font-size: 0.93rem;
        border-color: rgba(210, 193, 182, 0.2);
    }

    .table-row {
        transition: all 0.3s ease;
    }

    .table-row:hover {
        background-color: rgba(210, 193, 182, 0.1) !important;
        transform: scale(1.01);
        box-shadow: inset 0 0 0 2px rgba(210, 193, 182, 0.3);
    }

    /* Badge Styles */
    .bg-success-soft {
        background-color: rgba(69, 104, 130, 0.1) !important;
    }

    .bg-danger-soft {
        background-color: rgba(27, 60, 83, 0.1) !important;
    }

    .bg-primary-soft {
        background-color: rgba(27, 60, 83, 0.1) !important;
    }

    /* Button Styles */
    .hover-scale {
        transition: all 0.25s ease;
        background: #fff;
    }

    .hover-scale:hover {
        transform: scale(1.1);
        background: var(--background);
    }

    .btn-add-category {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(27, 60, 83, 0.25);
        text-decoration: none;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .btn-add-category:hover {
        transform: translateY(-2px) scale(1.03);
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-dark));
        box-shadow: 0 8px 18px rgba(27, 60, 83, 0.35);
        color: #fff;
    }

    /* Action Buttons */
    .btn-light {
        background: #fff;
        border: 1px solid var(--primary-light);
        color: var(--primary-medium);
        transition: all 0.3s ease;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .btn-light:hover {
        background: var(--background);
        border-color: var(--primary-medium);
        color: var(--primary-dark);
    }

    /* Animations */
    .fade-in {
        animation: fadeIn 0.8s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-header {
        animation: fadeDown 0.8s ease forwards;
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* SweetAlert Customization */
    .swal2-popup {
        border: 1px solid var(--primary-light) !important;
    }

    /* Text Colors */
    .text-primary-custom {
        color: var(--primary-dark) !important;
    }

    .text-secondary-custom {
        color: var(--primary-medium) !important;
    }

    .text-muted-custom {
        color: var(--primary-light) !important;
    }

    /* Timestamp Styling */
    .text-success {
        color: #456882 !important;
        font-weight: 600;
    }

    .text-muted {
        color: #8a9ba8 !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .table th:nth-child(4),
        .table td:nth-child(4) {
            display: none;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            min-width: 120px;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll(".btn-delete-trigger").forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                const form = this.closest("form");
                const row = this.closest("tr");

                Swal.fire({
                    title: '<strong style="color: #1b3c53; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">Yakin ingin menghapus kategori ini?</strong>',
                    html: '<p style="font-size:15px;color:#456882;margin-top:8px; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">Tindakan ini <b>tidak dapat dibatalkan</b>.</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Ya, hapus',
                    cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
                    reverseButtons: true,
                    background: '#f9f3ef',
                    backdrop: `rgba(27, 60, 83, 0.4)`,
                    confirmButtonColor: '#1b3c53',
                    cancelButtonColor: '#456882',
                    showClass: {
                        popup: 'animate__animated animate__zoomIn animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__zoomOut animate__faster'
                    },
                    customClass: {
                        popup: 'rounded-4 shadow-lg border',
                        confirmButton: 'btn px-4 py-2 fw-semibold shadow-sm rounded-3',
                        cancelButton: 'btn px-4 py-2 fw-semibold shadow-sm rounded-3'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar.',
                            icon: 'info',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            background: '#f9f3ef',
                            color: '#1b3c53',
                            didOpen: () => {
                                Swal.showLoading();
                                row.classList.add('animate__animated', 'animate__fadeOutLeft');
                                setTimeout(() => form.submit(), 600);
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Dibatalkan',
                            text: 'Kategori tidak jadi dihapus.',
                            icon: 'info',
                            timer: 1500,
                            showConfirmButton: false,
                            background: '#f9f3ef',
                            color: '#456882',
                            customClass: {
                                popup: 'rounded-4 shadow-lg border animate__animated animate__fadeIn'
                            }
                        });
                    }
                });
            });
        });

        // Auto refresh timestamp indicator
        setInterval(() => {
            document.querySelectorAll('.table-row').forEach(row => {
                const timestampElement = row.querySelector('.text-success');
                if (timestampElement) {
                    timestampElement.style.opacity = timestampElement.style.opacity === '0.7' ? '1' : '0.7';
                }
            });
        }, 2000);
    });
</script>
@endsection