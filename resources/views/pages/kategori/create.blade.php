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
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9e1d9;
    }

    .form-control-custom {
        border: 2px solid #d2c1b6;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fefcfb;
    }

    .form-control-custom:focus {
        border-color: #456882;
        box-shadow: 0 0 0 3px rgba(69, 104, 130, 0.1);
        background: white;
    }

    .form-label-custom {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #456882, #1b3c53);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(69, 104, 130, 0.3);
        color: white;
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #1b3c53;
    }

    .btn-secondary-custom:hover {
        background: #c4b0a3;
        transform: translateY(-2px);
        color: #1b3c53;
    }

    .form-section {
        background: #fefcfb;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 4px solid #456882;
    }

    .form-section h5 {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9e1d9;
    }

    .required-field::after {
        content: " *";
        color: #e74c3c;
    }
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom animate__animated animate__fadeInDown">
        <div>
            <h2 class="fw-bold mb-2">Tambah Kategori Baru</h2>
            <p class="mb-0 opacity-75">Buat kategori aset baru untuk mengorganisir inventaris</p>
        </div>
        <div>
            <i class="bi bi-tag" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="card-soft animate__animated animate__fadeInUp">
        <form action="{{ route('kategori-aset.store') }}" method="POST" id="kategoriForm">
            @csrf

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    {{-- INFORMASI KATEGORI --}}
                    <div class="form-section">
                        <h5><i class="bi bi-info-circle me-2"></i>Detail Kategori</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Nama Kategori</label>
                                <input type="text" name="nama" id="nama" class="form-control form-control-custom @error('nama') is-invalid @enderror" 
                                    value="{{ old('nama') }}" placeholder="Contoh: Elektronik / Kendaraan" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Kode Kategori</label>
                                <input type="text" name="kode" id="kode" class="form-control form-control-custom @error('kode') is-invalid @enderror" 
                                    value="{{ old('kode') }}" placeholder="Contoh: ELC / KND" required>
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" class="form-control form-control-custom" rows="4" 
                                placeholder="Masukkan keterangan tambahan mengenai kategori ini">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('kategori-aset.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaInput = document.getElementById('nama');
        const kodeInput = document.getElementById('kode');
        const form = document.getElementById('kategoriForm');

        // Otomatis buat kode kategori dari nama (4 karakter pertama)
        namaInput.addEventListener('blur', function() {
            if (!kodeInput.value) {
                const nama = this.value.trim();
                if (nama.length >= 3) {
                    kodeInput.value = nama.substring(0, 3).toUpperCase();
                }
            }
        });

        // SweetAlert konfirmasi sebelum submit
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Simpan Kategori Baru?',
                text: "Pastikan nama dan kode kategori sudah sesuai.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#1b3c53',
                cancelButtonColor: '#d2c1b6',
                background: '#fefcfb',
                borderRadius: '18px'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection