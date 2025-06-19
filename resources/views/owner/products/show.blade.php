@extends('layouts.app')

@section('title', 'Detail Produk (Owner)')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 mb-0">Detail Produk</h1>
        <a href="{{ route('owner.products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Produk</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-tag me-2"></i>Informasi Produk: {{ $product->name }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm">
                    @else
                        <div class="text-center p-4 border rounded bg-light">
                            <i class="fas fa-image fa-5x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">Nama Produk:</p>
                    <p class="lead">{{ $product->name }}</p>
                    <p class="fw-bold mt-3">Harga:</p>
                    <p class="fs-4 text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="fw-bold mt-3">Stok:</p>
                    <p class="fs-4">{{ $product->stock }} unit</p>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <p class="fw-bold">Deskripsi:</p>
                <p>{{ $product->description }}</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <p class="fw-bold">Dibuat pada:</p>
                    <p>{{ $product->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="fw-bold">Terakhir Diupdate:</p>
                    <p>{{ $product->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <a href="{{ route('owner.products.edit', $product->id) }}" class="btn btn-warning me-2"><i class="fas fa-edit me-2"></i>Edit Produk</a>
                <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" title="Hapus Produk"><i class="fas fa-trash-alt me-2"></i>Hapus Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection