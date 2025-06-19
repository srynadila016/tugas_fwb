<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(10);
        return view('buyer.transactions.history', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $transaction->load('items.product'); // Load related data
        return view('buyer.transactions.show', compact('transaction'));
    }
}