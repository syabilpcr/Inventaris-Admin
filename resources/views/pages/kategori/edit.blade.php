@extends('layouts.admin.app')

@section('title', 'Edit Kategori Aset')

@section('content')
<div class="container-fluid py-4">

    <h3>Edit Kategori Aset</h3>

    <form action="{{ route('kategori-aset.update', $kategori->kategori_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text"
                name="nama"
                class="form-control"
                value="{{ old('nama_kategori', $kategori->nama) }}"
                required>
        </div>

        <div class="mb-3">
            <label>Kode Kategori</label>
            <input type="text"
                name="kode"
                class="form-control"
                value="{{ $kategori->kode }}"
                readonly>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('kategori-aset.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection