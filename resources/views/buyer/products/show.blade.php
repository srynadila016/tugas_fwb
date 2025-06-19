@extends('layouts.app')

@section('title', $product->name . ' Details')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $product->name }}</h1>
    <a href="{{ route('buyer.products.index') }}" class="btn btn-secondary">Back to Catalog</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}" style="max-height: 300px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/300x300.png?text=No+Image" class="img-fluid rounded" alt="No Image">
                @endif
            </div>
            <div class="col-md-8">
                <h3 class="card-title">{{ $product->name }}</h3>
                <p class="card-text"><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                <p class="card-text">{{ $product->description }}</p>

                <form action="{{ route('buyer.cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    @if($product->stock > 0)
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    @else
                        <button type="button" class="btn btn-warning" disabled>Out of Stock</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection