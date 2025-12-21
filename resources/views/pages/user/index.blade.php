@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-header-custom" style="background: linear-gradient(135deg, #1b3c53, #456882); border-radius: 20px; padding: 35px 40px; color: white; margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <h2 class="fw-bold mb-2">Manajemen User</h2>
            <p class="mb-0 opacity-75">Kelola pengguna yang memiliki akses ke sistem</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold text-primary">
            <i class="bi bi-person-plus me-2"></i>Tambah User
        </a>
    </div>

    <div class="card-soft" style="background: white; border-radius: 18px; padding: 30px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 80px;">Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="Profile"
                            class="rounded-circle object-fit-cover"
                            style="width: 45px; height: 45px; border: 2px solid #d2c1b6;">
                        @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold"
                            style="width: 45px; height: 45px; border: 2px solid #d2c1b6; font-size: 0.8rem;">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                        <span class="badge bg-primary px-3 py-2 rounded-pill">Admin</span>
                        @else
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Staff</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus user ini?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection