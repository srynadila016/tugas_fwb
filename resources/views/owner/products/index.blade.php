@extends('layouts.app')

@section('title', 'Daftar Produk (Owner)')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 mb-0">Daftar Produk</h1>
        <a href="{{ route('owner.products.create') }}" class="btn btn-success"><i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Semua Produk Tersedia</h5>
        </div>
        <div class="card-body">
            @if($products->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Belum ada produk yang terdaftar.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                       @if($product->image)
                                            {{-- PASTIKAN INI ADALAH PATH YANG BENAR UNTUK GAMBAR PRODUK --}}
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            {{-- Placeholder jika tidak ada gambar --}}
                                            <i class="fas fa-image fa-2x text-muted"></i>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <a href="{{ route('owner.products.show', $product->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('owner.products.edit', $product->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Produk"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" title="Hapus Produk"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection