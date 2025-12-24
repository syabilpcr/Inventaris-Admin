@extends('layouts.admin.app')

@section('title', 'Manajemen User - Sistem Inventaris')

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

    .user-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #e9e1d9;
    }

    .user-img-placeholder {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(210, 193, 182, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1b3c53;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .role-badge {
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .role-admin { background: rgba(27, 60, 83, 0.1); color: #1b3c53; }
    .role-staff { background: rgba(69, 104, 130, 0.1); color: #456882; }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9e1d9;
    }

    /* Animasi */
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
            <h2 class="fw-bold mb-2">Manajemen User</h2>
            <p class="mb-0 opacity-75">Kelola data pengguna dan kontrol akses sistem</p>
        </div>
        <div>
            <i class="bi bi-people" style="font-size: 55px; opacity: .85;"></i>
        </div>
    </div>

    {{-- STATISTICS SECTION --}}
    <div class="row mb-4 animate-up" style="animation-delay: 0.1s;">
        <div class="col-md-4">
            <div class="info-section">
                <h5 class="fw-bold mb-1"><i class="bi bi-person-circle me-2"></i>Total User</h5>
                <p class="text-muted small mb-2">Seluruh akun terdaftar</p>
                <h3 class="fw-bold mb-0" style="color: #1b3c53;">{{ $users->count() }} <span class="fs-6 fw-normal">Orang</span></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section" style="border-left-color: #1b3c53;">
                <h5 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>Administrator</h5>
                <p class="text-muted small mb-2">User dengan akses penuh</p>
                <h3 class="fw-bold mb-0" style="color: #1b3c53;">{{ $users->where('role', 'admin')->count() }} <span class="fs-6 fw-normal">Akun</span></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section" style="border-left-color: #d2c1b6;">
                <h5 class="fw-bold mb-1"><i class="bi bi-person-badge me-2"></i>Staff / User</h5>
                <p class="text-muted small mb-2">User dengan akses terbatas</p>
                <h3 class="fw-bold mb-0" style="color: #1b3c53;">{{ $users->where('role', '!=', 'admin')->count() }} <span class="fs-6 fw-normal">Akun</span></h3>
            </div>
        </div>
    </div>

    {{-- CARD CONTENT --}}
    <div class="card-soft animate-up" style="animation-delay: 0.2s;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-person-lines-fill me-2"></i> Daftar Pengguna
            </h4>
            <a href="{{ route('user.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah User
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="70">NO</th>
                        <th width="80">FOTO</th>
                        <th>NAMA LENGKAP</th>
                        <th>EMAIL</th>
                        <th class="text-center">ROLE</th>
                        <th class="text-center" width="150">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="text-center fw-bold" style="color: #1b3c53;">{{ $loop->iteration }}</td>
                        <td>
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="user-img shadow-sm" alt="Profile">
                            @else
                                <div class="user-img-placeholder shadow-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold" style="color: #1b3c53;">{{ $user->name }}</div>
                            @if(auth()->id() == $user->id)
                                <span class="badge bg-success" style="font-size: 0.6rem;">SAYA</span>
                            @endif
                        </td>
                        <td style="color: #456882;">{{ $user->email }}</td>
                        <td class="text-center">
                            <span class="role-badge {{ $user->role == 'admin' ? 'role-admin' : 'role-staff' }}">
                                <i class="bi {{ $user->role == 'admin' ? 'bi-shield-shaded' : 'bi-person' }} me-1"></i>
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('user.edit', $user->id) }}" 
                                   class="btn-edit" title="Edit User">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @if(auth()->id() != $user->id)
                                <form action="{{ route('user.destroy', $user->id) }}" 
                                      method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete btn-delete-trigger" 
                                            data-name="{{ $user->name }}" 
                                            title="Hapus User">
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
                            <i class="bi bi-people text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="mt-3 text-muted">Belum ada pengguna terdaftar.</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Toast Alert untuk Success Session
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

        // 2. SweetAlert Konfirmasi Hapus
        const deleteButtons = document.querySelectorAll('.btn-delete-trigger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Hapus User?',
                    text: `Akun "${name}" akan dihapus permanen dari sistem.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b3c53',
                    cancelButtonColor: '#e74c3c',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    borderRadius: '15px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // 3. Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection