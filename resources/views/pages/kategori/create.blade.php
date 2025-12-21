@extends('layouts.admin.app')

@section('title', 'Tambah Kategori - Sistem Inventaris')

@section('content')
<div class="container-fluid py-4 px-4 main-wrapper animate__animated animate__fadeIn" style="background: #f9f3ef; min-height: 100vh;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate__animated animate__fadeInDown">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-plus-circle me-2" style="color: #456882;"></i> Tambah Kategori Baru
            </h2>
            <small style="color: #456882;">Buat kategori aset baru untuk sistem inventaris</small>
        </div>
        <a href="{{ route('kategori-aset.index') }}" class="btn btn-secondary-custom hover-scale">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card-custom shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp">
        <form method="POST" action="{{ route('kategori-aset.store') }}" id="kategoriForm">
            @csrf

            {{-- Error Alert --}}
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4"
                style="background: linear-gradient(135deg, #ef4444, #dc2626); border: none; color: white;">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Input Fields --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama" class="form-label fw-semibold" style="color: #1b3c53;">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama kategori"
                        required
                        style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px;">
                    @error('nama')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kode" class="form-label fw-semibold" style="color: #1b3c53;">Kode Kategori <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control"
                        id="kode"
                        name="kode"
                        value="{{ old('kode') }}"
                        placeholder="Masukkan kode kategori"
                        required
                        style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px;">
                    @error('kode')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold" style="color: #1b3c53;">Deskripsi</label>
                <textarea class="form-control"
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    placeholder="Masukkan deskripsi kategori (opsional)"
                    style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px;">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-2 pt-3">
                <a href="{{ route('kategori-aset.index') }}" class="btn btn-secondary-custom hover-scale">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom hover-scale" id="btnSubmit">
                    <i class="bi bi-check-circle me-2"></i> Simpan Kategori
                </button>
            </div>
        </form>
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
        font-family: 'Poppins', sans-serif;
    }

    .main-wrapper {
        max-width: 100%;
    }

    /* Card dan Input */
    .card-custom {
        background: #fff;
        border-radius: 1.2rem;
        padding: 2rem;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(27, 60, 83, 0.08);
        border: 1px solid rgba(210, 193, 182, 0.3);
    }

    .card-custom:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(27, 60, 83, 0.12);
    }

    .form-label {
        color: var(--primary-dark);
        margin-bottom: 6px;
    }

    .form-control {
        border: 1.5px solid var(--primary-light);
        border-radius: 10px;
        padding: 10px 12px;
        transition: all 0.3s ease;
        color: var(--primary-dark);
    }

    .form-control:focus {
        border-color: var(--primary-medium);
        box-shadow: 0 0 8px rgba(69, 104, 130, 0.25);
        outline: none;
    }

    /* Radio Button Styling */
    .form-check-input:checked {
        background-color: var(--primary-medium);
        border-color: var(--primary-medium);
    }

    .form-check-input:focus {
        border-color: var(--primary-medium);
        box-shadow: 0 0 0 0.2rem rgba(69, 104, 130, 0.25);
    }

    /* Tombol */
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
        border: none;
        color: white;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(27, 60, 83, 0.25);
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(27, 60, 83, 0.35);
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-dark));
        color: white;
    }

    .btn-secondary-custom {
        background: var(--primary-medium);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(69, 104, 130, 0.25);
    }

    .btn-secondary-custom:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(27, 60, 83, 0.35);
        color: white;
    }

    .hover-scale {
        transition: all 0.25s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    /* Placeholder styling */
    ::placeholder {
        color: #d2c1b6 !important;
        opacity: 0.7;
    }

    /* Error styling */
    .text-danger {
        color: #dc3545 !important;
        font-size: 0.875rem;
    }

    /* Alert customization */
    .alert {
        border-radius: 10px;
        border: none;
    }

    /* Responsif */
    @media (max-width: 992px) {
        .card-custom {
            padding: 1.5rem;
        }

        .d-flex.justify-content-end {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
        }

        .d-flex.gap-4.flex-wrap {
            gap: 15px !important;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaInput = document.getElementById('nama');
        const kodeInput = document.getElementById('kode');
        const form = document.getElementById('kategoriForm');

        // Otomatis buat kode kategori dari nama
        namaInput.addEventListener('blur', function() {
            if (!kodeInput.value) {
                const nama = this.value.trim();
                if (nama.length >= 4) {
                    kodeInput.value = nama.substring(0, 4).toUpperCase();
                }
            }
        });

        // SweetAlert konfirmasi sebelum submit
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '<strong style="color: #1b3c53">Simpan Kategori Baru?</strong>',
                html: '<p style="color: #456882; margin-top: 8px;">Pastikan semua data sudah benar.</p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-check-circle me-1"></i> Ya, Simpan!',
                cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
                confirmButtonColor: '#1b3c53',
                cancelButtonColor: '#456882',
                background: '#f9f3ef',
                customClass: {
                    popup: 'rounded-4 animate__animated animate__zoomIn shadow-lg border',
                    confirmButton: 'btn px-4 py-2 fw-semibold shadow-sm rounded-3',
                    cancelButton: 'btn px-4 py-2 fw-semibold shadow-sm rounded-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        background: '#f9f3ef',
                        color: '#1b3c53',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        customClass: {
                            popup: 'rounded-4 animate__animated animate__fadeIn shadow-lg border'
                        }
                    });
                    setTimeout(() => form.submit(), 1000);
                }
            });
        });

        // Notifikasi sukses setelah simpan
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('
            success ') }}',
            showConfirmButton: false,
            timer: 2000,
            toast: true,
            position: 'top-end',
            background: '#f9f3ef',
            color: '#456882',
            customClass: {
                popup: 'rounded-4 animate__animated animate__fadeInDown shadow-lg border',
                icon: 'text-success'
            }
        });
        @endif
    });
</script>
@endsection