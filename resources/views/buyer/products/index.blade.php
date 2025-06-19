@extends('layouts.app') {{-- Anggap ada layout dasar di buyer/layouts/app.blade.php --}}

@section('title', 'Product Catalog')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product Catalog</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @forelse($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
            @else
                <img src="https://via.placeholder.com/200x200.png?text=No+Image" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ Str::limit($product->description, 70) }}</p>
                <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                <a href="{{ route('buyer.products.show', $product->id) }}" class="btn btn-info btn-sm">View Details</a>
                <form action="{{ route('buyer.cart.add') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1"> {{-- Default to 1, user can change in cart --}}
                    <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p>No products available at the moment.</p>
    </div>
    @endforelse
</div>
@endsection