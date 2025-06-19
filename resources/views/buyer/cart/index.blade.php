@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Cart</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($cartItems->isEmpty())
    <p>Your cart is empty. <a href="{{ route('buyer.products.index') }}">Start shopping!</a></p>
@else
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPrice = 0; @endphp
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('buyer.cart.update') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm w-50 d-inline" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('buyer.cart.remove', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this item from your cart?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @php $totalPrice += ($item->product->price * $item->quantity); @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total:</th>
                    <th>Rp {{ number_format($totalPrice, 0, ',', '.') }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-end">
        <a href="{{ route('buyer.checkout.index') }}" class="btn btn-success btn-lg">Proceed to Checkout</a>
    </div>
@endif
@endsection