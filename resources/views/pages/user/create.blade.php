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
        margin-bottom: 50px;
    }

    /* Style Khusus Upload Foto */
    .image-upload-wrapper {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 15px;
    }

    .image-preview {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #f9f3ef;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: block;
    }

    .btn-upload-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: #456882;
        color: white;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid white;
        transition: all 0.3s;
    }

    .btn-upload-icon:hover {
        background: #1b3c53;
        transform: scale(1.1);
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
        color: white !important;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #456882, #1b3c53);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(69, 104, 130, 0.3);
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #1b3c53 !important;
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

    .help-text {
        color: #456882;
        font-size: 0.85rem;
        margin-top: 5px;
    }
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Tambah Pengguna Baru</h2>
            <p class="mb-0 opacity-75">Daftarkan akun pengguna baru ke dalam sistem</p>
        </div>
        <div>
            <i class="bi bi-person-plus" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    <div class="card-soft">
        {{-- Atribut enctype sangat penting untuk upload file --}}
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    
                    {{-- UPLOAD FOTO SECTION --}}
                    <div class="text-center mb-5">
                        <div class="image-upload-wrapper">
                            {{-- Preview Gambar --}}
                            <img src="https://ui-avatars.com/api/?name=User&background=d2c1b6&color=1b3c53&size=128" 
                                 id="preview-foto" class="image-preview" alt="Preview Foto">
                            
                            {{-- Label sebagai tombol klik --}}
                            <label for="foto-input" class="btn-upload-icon">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            
                            {{-- Input File Hidden --}}
                            <input type="file" name="foto" id="foto-input" class="d-none" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #1b3c53;">Foto Profil</h6>
                        <p class="text-muted small mb-0">Klik ikon kamera untuk memilih foto</p>
                        @error('foto') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror
                    </div>

                    {{-- INFORMASI PROFIL --}}
                    <div class="form-section">
                        <h5><i class="bi bi-person-vcard me-2"></i>Informasi Profil</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control form-control-custom" 
                                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom required-field">Alamat Email</label>
                                <input type="email" name="email" class="form-control form-control-custom" 
                                    value="{{ old('email') }}" placeholder="contoh@email.com" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- KEAMANAN & ROLE --}}
                    <div class="form-section">
                        <h5><i class="bi bi-shield-lock me-2"></i>Keamanan & Hak Akses</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom required-field">Role / Hak Akses</label>
                                <select name="role" class="form-select form-control-custom" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <p class="help-text">Admin memiliki akses penuh, Staff memiliki akses terbatas.</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom required-field">Password</label>
                                <input type="password" name="password" class="form-control form-control-custom" 
                                    placeholder="minimal 8 karakter" required>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom required-field">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-custom" 
                                    placeholder="ulangi password" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('user.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk Preview Foto Otomatis --}}
<script>
    document.getElementById('foto-input').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            // Validasi sederhana ukuran file (opsional, misal 2MB)
            if(file.size > 2097152){
                alert("Ukuran file terlalu besar! Maksimal 2MB.");
                this.value = "";
                return;
            };
            
            // Tampilkan Preview
            document.getElementById('preview-foto').src = URL.createObjectURL(file)
        }
    }
</script>
@endsection