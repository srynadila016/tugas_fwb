@extends('layouts.app')

@section('title', 'Edit Produk (Owner)')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 mb-0">Edit Produk: {{ $product->name }}</h1>
        <a href="{{ route('owner.products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Produk</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Produk</h5>
        </div>
        <div class="card-body">
            {{-- Tambahkan enctype="multipart/form-data" untuk upload file --}}
            <form action="{{ route('owner.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Penting untuk metode PUT --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Input untuk Gambar Produk (dengan preview) --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($product->image)
                        <div class="mt-2">
                            <p class="mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="Gambar Produk" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    @endif
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning btn-lg text-white"><i class="fas fa-sync-alt me-2"></i>Update Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection