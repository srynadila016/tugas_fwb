<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:custom_user,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,paid,shipped,completed'
        ]);

        return Transaction::create($validated);
    }

    public function show($id)
    {
        return Transaction::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        return $transaction;
    }

    public function destroy($id)
    {
        return Transaction::destroy($id);
    }
}