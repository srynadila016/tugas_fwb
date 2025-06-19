@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Checkout</h1>
</div>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($cartItems->isEmpty())
    <p>Your cart is empty. Please add items to your cart before checking out.</p>
    <a href="{{ route('buyer.products.index') }}" class="btn btn-primary">Go to Product Catalog</a>
@else
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Order Summary</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPrice = 0; @endphp
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @php $totalPrice += ($item->product->price * $item->quantity); @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th>Rp {{ number_format($totalPrice, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Shipping Information</div>
                <div class="card-body">
                    <form action="{{ route('buyer.checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        {{-- Add payment method selection if applicable --}}
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">Select a payment method</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="credit_card">Credit Card (Dummy)</option>
                                {{-- Add more payment options --}}
                            </select>
                            @error('payment_method') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Your Total</div>
                <div class="card-body text-center">
                    <h2 class="card-title">Rp {{ number_format($totalPrice, 0, ',', '.') }}</h2>
                    <p class="card-text text-muted">Excluding shipping fees (if any).</p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection