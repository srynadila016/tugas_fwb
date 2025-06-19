@extends('layouts.app')

@section('title', 'Product Details: ' . $product->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Product List</a>
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
                <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                <p class="card-text"><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning mt-3">Edit Product</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline ms-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection