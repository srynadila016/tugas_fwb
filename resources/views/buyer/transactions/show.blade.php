@extends('layouts.app')

@section('title', 'Transaction Details #'.$transaction->id)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Transaction Details #{{ $transaction->id }}</h1>
    <a href="{{ route('buyer.transactions.index') }}" class="btn btn-secondary">Back to History</a>
</div>

<div class="card mb-4">
    <div class="card-header">Transaction Information</div>
    <div class="card-body">
        <p><strong>Transaction ID:</strong> #{{ $transaction->id }}</p>
        <p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
        <p><strong>Total Amount:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> <span class="badge {{ $transaction->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">{{ ucfirst($transaction->status) }}</span></p>
        <p><strong>Shipping Address:</strong> {{ $transaction->shipping_address }}</p>
        <p><strong>Phone Number:</strong> {{ $transaction->phone_number }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</p>
    </div>
</div>

<div class="card">
    <div class="card-header">Items Purchased</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection