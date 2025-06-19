@extends('layouts.app')
@section('title', 'Semua Produk')
@section('content')
    <h1 class="mb-4">Produk Tersedia</h1>
    <p class="lead">Jelajahi berbagai produk menarik yang kami tawarkan.</p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $product->name }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div>
                                <p class="card-text mb-0"><small class="text-muted">Harga:</small></p>
                                <h6 class="card-title text-success mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                            </div>
                            <div>
                                <p class="card-text mb-0 text-end"><small class="text-muted">Stok:</small></p>
                                <h6 class="card-title text-info mb-0">{{ $product->stock > 0 ? $product->stock : 'Habis' }}</h6>
                            </div>
                        </div>
                        <div class="d-grid mt-3">
                            <a href="{{ route('public.products.show', $product->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-info-circle me-2"></i>Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    Maaf, tidak ada produk yang tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
@endsection