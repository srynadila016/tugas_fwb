@extends('layouts.app')

@section('title', 'Edit Product: ' . $product->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Product List</a>
</div>

<div class="card">
    <div class="card-header">Edit Product</div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting untuk method PUT/PATCH --}}

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price (Rp)</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" step="any" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                @if($product->image)
                    <div class="mb-2">
                        Current Image: <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                <div class="form-text">Leave blank to keep current image.</div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
@endsection