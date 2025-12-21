@extends('layouts.admin.app')

@section('content')
<style>
    body {
        background: #f9f3ef !important;
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
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9e1d9;
    }

    .form-label-custom {
        color: #1b3c53;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border: 2px solid #d2c1b6;
        border-radius: 12px;
        padding: 12px;
        transition: all 0.3s ease;
        background: #fefcfb;
    }

    .form-control-custom:focus {
        border-color: #456882;
        box-shadow: 0 0 0 3px rgba(69, 104, 130, 0.1);
    }
</style>

<div class="container-fluid px-4">
    {{-- HEADER --}}
    <div class="page-header-custom">
        <div>
            <h2 class="fw-bold mb-2">Edit Pengguna</h2>
            <p class="mb-0 opacity-75">Perbarui profil atau hak akses pengguna sistem</p>
        </div>
        <i class="bi bi-person-gear" style="font-size: 55px; opacity: .85;"></i>
    </div>

    {{-- CONTENT --}}
    <div class="card-soft">
        @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control form-control-custom"
                        value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom">Alamat Email</label>
                    <input type="email" name="email" class="form-control form-control-custom"
                        value="{{ old('email', $user->email) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Role / Hak Akses</label>
                <select name="role" class="form-select form-control-custom" required>
                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <hr class="my-4" style="border-top: 2px dashed #d2c1b6;">

            <div class="alert alert-info border-0 shadow-sm" style="border-radius: 12px;">
                <i class="bi bi-info-circle me-2"></i>
                Kosongkan kolom password di bawah jika Anda <strong>tidak ingin</strong> mengubah password.
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control form-control-custom"
                        placeholder="********">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-custom"
                        placeholder="********">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('user.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 12px; background: #d2c1b6; border: none; color: #1b3c53; font-weight: 600;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 12px; background: #1b3c53; border: none; font-weight: 600;">
                    <i class="bi bi-save me-2"></i> Perbarui User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection