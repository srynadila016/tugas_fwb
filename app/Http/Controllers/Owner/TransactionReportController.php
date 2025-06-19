<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        $transactions = $query->latest()->paginate(10);
        $statuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled']; // For filter dropdown

        return view('owner.reports.transactions', compact('transactions', 'statuses'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('user', 'items.product'); // Load related data
        return view('owner.reports.transaction_detail', compact('transaction'));
    }
}