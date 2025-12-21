@extends('layouts.admin.master')

@section('title', 'Edit Kategori Aset')

@section('content')
<div class="container-fluid py-4">

    <h3>Edit Kategori Aset</h3>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text"
                name="nama_kategori"
                class="form-control"
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                required>
        </div>

        <div class="mb-3">
            <label>Kode Kategori</label>
            <input type="text"
                class="form-control"
                value="{{ $kategori->kode_kategori }}"
                readonly>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="1" {{ old('status', $kategori->status) == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status', $kategori->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
            </select>

        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection