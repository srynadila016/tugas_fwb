<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function create()
    {
        $buyers = User::where('role', 'pembeli')->get();
        $products = Product::where('stock', '>', 0)->get();
        return view('admin.sales.create', compact('buyers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $items = [];

            foreach ($request->products as $item) {
                $product = Product::find($item['id']);
                if (!$product || $product->stock < $item['quantity']) {
                    DB::rollBack();
                    return back()->withInput()->with('error', 'Stok produk ' . ($product->name ?? 'unknown') . ' tidak mencukupi.');
                }
                $subtotal = $product->price * $item['quantity'];
                $totalPrice += $subtotal;
                $items[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
                $product->decrement('stock', $item['quantity']);
            }

            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'total_price' => $totalPrice,
                'status' => 'paid', // Admin input implies paid
            ]);

            foreach ($items as $item) {
                $transaction->items()->create($item);
            }

            DB::commit();
            return redirect()->route('admin.sales.show', $transaction->id)->with('success', 'Transaksi berhasil diinput!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menginput transaksi: ' . $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('user', 'items.product');
        return view('admin.sales.show', compact('transaction'));
    }
}