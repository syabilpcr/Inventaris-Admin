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

    .user-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #d2c1b6;
    }

    .user-img-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #d2c1b6;
        background: #f9f3ef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1b3c53;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #456882;
    }

    .badge-role {
        padding: 6px 14px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9e1d9;
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
            <h2 class="fw-bold mb-2">Manajemen User</h2>
            <p class="mb-0 opacity-75">Kelola pengguna dan hak akses sistem</p>
        </div>
        <div>
            <i class="bi bi-people" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    {{-- STATISTICS SECTION --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="info-section">
                <h5 class="fw-bold"><i class="bi bi-person-check me-2"></i>Total Pengguna</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #1b3c53;">{{ $users->count() }} Orang</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-section" style="border-left-color: #1b3c53;">
                <h5 class="fw-bold"><i class="bi bi-shield-lock me-2"></i>Administrator</h5>
                <p class="fw-bold fs-4 mb-0" style="color: #1b3c53;">{{ $users->where('role', 'admin')->count() }} Akun</p>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-list-stars me-2"></i> Daftar Pengguna
            </h4>
            <a href="{{ route('user.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-person-plus me-1"></i> Tambah User
            </a>
        </div>

        @if(session('success'))
        <div class="alert-custom">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px">NO</th>
                        <th style="width: 80px">FOTO</th>
                        <th>NAMA LENGKAP</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th class="text-center" style="width: 150px">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1; @endphp
                    @forelse($users as $user)
                    <tr>
                        <td class="fw-bold text-center" style="color: #1b3c53;">{{ $counter++ }}</td>
                        <td>
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="user-img" alt="Profile">
                            @else
                                <div class="user-img-placeholder">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="color: #1b3c53; font-weight: 600;">{{ $user->name }}</div>
                            @if(auth()->id() == $user->id)
                                <small class="badge bg-soft-primary text-primary" style="background: #e7f1ff; font-size: 0.65rem;">SAYA</small>
                            @endif
                        </td>
                        <td style="color: #456882;">{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-primary badge-role text-white">
                                    <i class="bi bi-shield-shaded me-1"></i> Admin
                                </span>
                            @else
                                <span class="badge bg-light text-dark border badge-role">
                                    <i class="bi bi-person me-1"></i> Staff
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn-edit" title="Edit User">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                @if(auth()->id() != $user->id)
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Hapus User" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Tidak ada data pengguna ditemukan.</p>
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
        // Tooltip initialization
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection