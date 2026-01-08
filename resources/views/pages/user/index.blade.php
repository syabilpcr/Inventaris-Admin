@extends('layouts.admin.app')

@section('title', 'Manajemen User - Sistem Inventaris')

@section('content')

<style>
    body {
        background: #f9f3ef !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Header Styling */
    .page-header-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border-radius: 20px;
        padding: 30px 40px;
        color: white;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 25px rgba(27, 60, 83, 0.15);
    }

    /* Developer Identity Card - UKURAN DIPERBESAR */
    .dev-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        border: 1px solid #e9e1d9;
    }

    .dev-image-side {
        width: 250px;
        background: #1b3c53;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }

    .dev-img {
        width: 180px;
        height: 180px;
        border-radius: 20px;
        object-fit: cover;
        border: 5px solid rgba(255, 255, 255, 0.15);
        transition: transform 0.3s ease;
    }

    .dev-card:hover .dev-img {
        transform: scale(1.05);
    }

    .dev-info-side {
        flex: 1;
        padding: 35px 40px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dev-badge {
        position: absolute;
        top: 25px;
        right: 30px;
        background: rgba(27, 60, 83, 0.08);
        color: #1b3c53;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Social Links - SEKARANG MENGGUNAKAN SPAN (TIDAK BISA DIKLIK) */
    .social-links span {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 8px;
        transition: all 0.3s;
        font-size: 1.2rem;
        cursor: default;
    }

    .social-linkedin {
        background: #e8f2f8;
        color: #0077b5;
    }

    .social-github {
        background: #f0f0f0;
        color: #333;
    }

    .social-instagram {
        background: #fdf0f2;
        color: #e4405f;
    }

    /* Table & Cards */
    .card-soft {
        background: white;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9e1d9;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #456882;
    }

    .table th {
        background: linear-gradient(135deg, #1b3c53, #456882) !important;
        color: white;
        padding: 15px;
        font-size: 0.85rem;
    }

    /* CUSTOM ACTION BUTTONS (SESUAI GAMBAR) */
    .btn-custom-edit {
        background: #d2c1b6 !important;
        color: #1b3c53 !important;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        transition: all 0.3s;
    }

    .btn-custom-delete {
        background: #e74c3c !important;
        color: white !important;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        transition: all 0.3s;
    }

    .btn-custom-edit:hover,
    .btn-custom-delete:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .user-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 10px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1b3c53, #456882);
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        text-decoration: none;
    }

    .role-badge {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .role-admin {
        background: rgba(27, 60, 83, 0.1);
        color: #1b3c53;
    }

    .role-staff {
        background: rgba(69, 104, 130, 0.1);
        color: #456882;
    }

    /* Animations */
    .animate-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .dev-card {
            flex-direction: column;
        }

        .dev-image-side {
            width: 100%;
            padding: 40px;
        }

        .dev-info-side {
            text-align: center;
            padding: 30px;
        }

        .dev-badge {
            position: static;
            margin-bottom: 15px;
            display: inline-block;
        }

        .social-links {
            justify-content: center;
            display: flex;
        }
    }
</style>

<div class="container-fluid px-4 mt-4">

    {{-- HEADER --}}
    <div class="page-header-custom animate-up">
        <div>
            <h2 class="fw-bold mb-1">Manajemen User</h2>
            <p class="mb-0 opacity-75 small">Kelola data pengguna dan kontrol akses sistem</p>
        </div>
        <i class="bi bi-people d-none d-md-block" style="font-size: 45px; opacity: .8;"></i>
    </div>

    {{-- DEVELOPER IDENTITY CARD (ENLARGED) --}}
    <div class="dev-card animate-up" style="animation-delay: 0.1s;">
        <div class="dev-image-side">
            <img src="{{ asset('images/Foto_Kader.jpg') }}" class="dev-img shadow-lg" alt="Dev Photo">
        </div>
        <div class="dev-info-side">
            <span class="dev-badge">System Developer</span>
            <h2 class="fw-bold mb-2" style="color: #1b3c53; letter-spacing: -0.5px;">Muhammad Syabil Al Jabbar</h2>
            <p class="text-muted mb-4 fs-5">
                <span class="badge bg-light text-dark border me-2">
                    <i class="bi bi-hash me-1" style="color: #1b3c53;"></i> 2457301098
                </span>
                <span class="badge bg-light text-dark border me-2">
                    <i class="bi bi-mortarboard me-1" style="color: #1b3c53;"></i> Sistem Informasi
                </span>
                <span class="badge bg-light text-dark border">
                    <i class="bi bi-building-fill me-1" style="color: #1b3c53;"></i> Politeknik Caltex Riau
                </span>
            </p>

            <div class="d-flex flex-wrap justify-content-between align-items-center mt-auto">
                {{-- SOCIAL LINKS MENGGUNAKAN SPAN --}}
                <div class="social-links">
                
                    <a href="https://github.com/USERNAME_GITHUB_ANDA" target="_blank" class="social-github" title="GitHub">
                        <i class="bi bi-github"></i>
                    </a>

                    <a href="https://www.instagram.com/syabil.ajbr" target="_blank" class="social-instagram" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
                <div class="text-muted fw-medium">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Pekanbaru, Riau
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row mb-2 animate-up" style="animation-delay: 0.15s;">
        <div class="col-md-4">
            <div class="info-section">
                <h6 class="fw-bold mb-1"><i class="bi bi-person-circle me-2"></i>Total User</h6>
                <h3 class="fw-bold mb-0" style="color: #1b3c53;">{{ $users->count() }} <span class="fs-6 fw-normal text-muted">Orang</span></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section" style="border-left-color: #1b3c53;">
                <h6 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>Admin</h6>
                <h3 class="fw-bold mb-0" style="color: #1b3c53;">{{ $users->where('role', 'admin')->count() }} <span class="fs-6 fw-normal text-muted">Akun</span></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-section" style="border-left-color: #d2c1b6;">
                <h6 class="fw-bold mb-1"><i class="bi bi-person-badge me-2"></i>Staff</h6>
                <h3 class="fw-bold mb-0" style="color: #1b3c53;">{{ $users->where('role', '!=', 'admin')->count() }} <span class="fs-6 fw-normal text-muted">Akun</span></h3>
            </div>
        </div>
    </div>

    {{-- MAIN TABLE CARD --}}
    <div class="card-soft animate-up" style="animation-delay: 0.2s;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-person-lines-fill me-2"></i> Daftar Pengguna
            </h5>
            <a href="{{ route('user.create') }}" class="btn btn-primary-custom shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah User
            </a>
        </div>

        <div class="table-responsive shadow-sm" style="border-radius: 12px; border: 1px solid #e9e1d9;">
            <table class="table table-hover mb-0">
                <thead>
                    <tr class="text-center">
                        <th width="60">NO</th>
                        <th width="80">FOTO</th>
                        <th class="text-start">NAMA LENGKAP</th>
                        <th class="text-start">EMAIL</th>
                        <th>ROLE</th>
                        <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="text-center align-middle">
                        <td class="fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            @if($user->profile_picture && Storage::disk('public')->exists($user->profile_picture))
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" class="user-img shadow-sm" alt="Profile">
                            @else
                            <img src="{{ asset('images/Foto_profil.jpg') }}" class="user-img shadow-sm" alt="Default">
                            @endif
                        </td>
                        <td class="text-start">
                            <div class="fw-bold" style="color: #1b3c53;">{{ $user->name }}</div>
                            @if(auth()->id() == $user->id)
                            <span class="badge bg-success" style="font-size: 0.6rem;">SAYA</span>
                            @endif
                        </td>
                        <td class="text-start" style="color: #456882; font-size: 0.9rem;">{{ $user->email }}</td>
                        <td>
                            <span class="role-badge {{ $user->role == 'admin' ? 'role-admin' : 'role-staff' }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- EDIT BUTTON (KREM) --}}
                                <a href="{{ route('user.edit', $user->id) }}" class="btn-custom-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- DELETE BUTTON (MERAH) --}}
                                @if(auth()->id() != $user->id)
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-custom-delete btn-delete-trigger" data-name="{{ $user->name }}">
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
                            <i class="bi bi-people text-muted" style="font-size: 3rem; opacity: 0.2;"></i>
                            <p class="text-muted mt-2">Belum ada data pengguna.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        const deleteButtons = document.querySelectorAll('.btn-delete-trigger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                const name = this.getAttribute('data-name');
                Swal.fire({
                    title: 'Hapus User?',
                    text: `Akun "${name}" akan dihapus permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b3c53',
                    cancelButtonColor: '#e74c3c',
                    confirmButtonText: 'Ya, Hapus!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    });
</script>

@endsection