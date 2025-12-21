@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="card-soft" style="background: white; border-radius: 18px; padding: 30px; margin-top: 30px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);">
        <h3 class="fw-bold mb-4 text-dark">Edit Pengguna</h3>

        {{-- Enctype wajib ada untuk update file --}}
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <label class="form-label d-block fw-bold mb-3">Foto Profil Saat Ini</label>
                    @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                        id="preview-foto"
                        alt="Profile"
                        class="rounded-circle object-fit-cover mb-2"
                        style="width: 120px; height: 120px; border: 4px solid #d2c1b6;">
                    @else
                    <div id="placeholder-foto" class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2"
                        style="width: 120px; height: 120px; border: 4px solid #d2c1b6; font-size: 2rem;">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control border-2" style="border-radius: 10px;"
                        value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control border-2" style="border-radius: 10px;"
                        value="{{ old('email', $user->email) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-select border-2" style="border-radius: 10px;">
                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Ganti Foto Profil</label>
                    <input type="file" name="profile_picture" class="form-control border-2"
                        style="border-radius: 10px;" accept="image/*" onchange="previewImage(this)">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                </div>
            </div>

            <hr class="my-4">
            <h5 class="fw-bold text-muted mb-3">Ganti Password (Opsional)</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Password Baru</label>
                    <input type="password" name="password" class="form-control border-2" style="border-radius: 10px;"
                        placeholder="********">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control border-2"
                        style="border-radius: 10px;" placeholder="********">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('user.index') }}" class="btn btn-secondary px-4" style="border-radius: 10px;">Batal</a>
                <button type="submit" class="btn btn-primary px-4" style="background: #1b3c53; border: none; border-radius: 10px;">
                    <i class="bi bi-save me-2"></i> Perbarui User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk preview gambar sebelum diupload
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Jika sebelumnya ada placeholder teks, kita ganti jadi element img
                let preview = document.getElementById('preview-foto');
                let placeholder = document.getElementById('placeholder-foto');

                if (placeholder) {
                    placeholder.style.display = 'none';
                    // Buat elemen img baru jika sebelumnya tidak ada foto
                    let newImg = document.createElement('img');
                    newImg.id = 'preview-foto';
                    newImg.className = 'rounded-circle object-fit-cover mb-2 mx-auto d-block';
                    newImg.style = 'width: 120px; height: 120px; border: 4px solid #d2c1b6;';
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