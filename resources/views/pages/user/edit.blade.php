@extends('layouts.admin.app')

@section('content')
<style>
    body {
        background: #f9f3ef !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header-custom {
        background: linear-gradient(135deg, #456882, #1b3c53);
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
        padding: 35px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9e1d9;
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

    .form-control-custom {
        border: 2px solid #d2c1b6;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: #456882;
        box-shadow: 0 0 0 3px rgba(69, 104, 130, 0.1);
        outline: none;
    }

    .form-label-custom {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .profile-preview-container {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(27, 60, 83, 0.2);
        color: white;
    }

    .btn-secondary-custom {
        background: #d2c1b6;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        color: #1b3c53;
        text-decoration: none;
        transition: 0.3s;
    }
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom animate__animated animate__fadeInDown">
        <div>
            <h2 class="fw-bold mb-2">Edit Pengguna</h2>
            <p class="mb-0 opacity-75">Manajemen akun dan hak akses pengguna sistem</p>
        </div>
        <i class="bi bi-person-gear" style="font-size: 55px; opacity: .85;"></i>
    </div>

    <div class="card-soft animate__animated animate__fadeInUp">
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- SISI KIRI: FOTO PROFIL --}}
                <div class="col-lg-3 text-center border-end">
                    <div class="form-section bg-transparent border-0">
                        <label class="form-label-custom d-block mb-4">Foto Profil</label>
                        <div class="profile-preview-container">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                     id="preview-foto" 
                                     class="rounded-circle object-fit-cover shadow-sm" 
                                     style="width: 160px; height: 160px; border: 5px solid #fff; outline: 2px solid #d2c1b6;">
                            @else
                                <div id="placeholder-foto" 
                                     class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold mx-auto shadow-sm"
                                     style="width: 160px; height: 160px; border: 5px solid #fff; outline: 2px solid #d2c1b6; font-size: 3rem;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <label for="profile_picture" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="bi bi-camera me-1"></i> Pilih Foto Baru
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="d-none" accept="image/*" onchange="previewImage(this)">
                        </div>
                        <small class="text-muted d-block mt-2">Format: JPG, PNG (Maks. 2MB)</small>
                    </div>
                </div>

                {{-- SISI KANAN: FORM DATA --}}
                <div class="col-lg-9">
                    <div class="form-section">
                        <h5><i class="bi bi-card-heading me-2"></i>Informasi Akun</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control form-control-custom shadow-none" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Alamat Email</label>
                                <input type="email" name="email" class="form-control form-control-custom shadow-none" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Role / Hak Akses</label>
                                <select name="role" class="form-select form-control-custom shadow-none">
                                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff (Akses Terbatas)</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5><i class="bi bi-shield-lock me-2"></i>Keamanan</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Password Baru</label>
                                <input type="password" name="password" class="form-control form-control-custom shadow-none" placeholder="Isi hanya jika ingin mengganti">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-custom shadow-none" placeholder="Ulangi password baru">
                            </div>
                        </div>
                        <small class="text-danger"><i class="bi bi-info-circle me-1"></i>Kosongkan jika tidak ada perubahan pada password.</small>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('user.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('preview-foto');
                let placeholder = document.getElementById('placeholder-foto');

                if (placeholder) {
                    placeholder.style.display = 'none';
                    let newImg = document.createElement('img');
                    newImg.id = 'preview-foto';
                    newImg.className = 'rounded-circle object-fit-cover shadow-sm';
                    newImg.style = 'width: 160px; height: 160px; border: 5px solid #fff; outline: 2px solid #d2c1b6;';
                    newImg.src = e.target.result;
                    placeholder.parentNode.appendChild(newImg);
                } else {
                    preview.src = e.target.result;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection