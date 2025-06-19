@extends('layouts.app')

@section('title', 'Tambah Produk Baru (Owner)')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 mb-0">Tambah Produk Baru</h1>
        <a href="{{ route('owner.products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Produk</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Form Produk Baru</h5>
        </div>
        <div class="card-body">
            {{-- Tambahkan enctype="multipart/form-data" untuk upload file --}}
            <form action="{{ route('owner.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" required min="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Input untuk Gambar Produk --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Unggah gambar produk (opsional, max 2MB).</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save me-2"></i>Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection