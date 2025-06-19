@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @else
                        <img src="https://via.placeholder.com/50x50.png?text=No+Img" alt="No Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    {{-- <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection