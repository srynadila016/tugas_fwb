@extends('layouts.app')

@section('title', 'Transaction History')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Transaction History</h1>
</div>

@if($transactions->isEmpty())
    <p>You have no past transactions.</p>
@else
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->id }}</td>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge {{ $transaction->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">{{ ucfirst($transaction->status) }}</span></td>
                        <td>
                            <a href="{{ route('buyer.transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection