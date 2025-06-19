<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('buyer.cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalPrice = $cartItems->sum(function($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        // Check stock availability again before showing checkout
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('buyer.cart.index')->with('error', 'Maaf, stok produk "' . $item->product->name . '" tidak mencukupi. Silakan sesuaikan jumlah di keranjang Anda.');
            }
        }

        return view('buyer.checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('buyer.cart.index')->with('error', 'Keranjang Anda kosong. Tidak ada yang bisa dicheckout.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $transactionItemsData = [];

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;

                if ($cartItem->quantity > $product->stock) {
                    DB::rollBack();
                    return redirect()->route('buyer.cart.index')->with('error', 'Maaf, stok produk "' . $product->name . '" tidak mencukupi (' . $product->stock . ' tersedia). Silakan sesuaikan jumlah di keranjang Anda.');
                }

                $subtotal = $product->price * $cartItem->quantity;
                $totalPrice += $subtotal;

                $transactionItemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $subtotal,
                ];

                // Kurangi stok produk
                $product->decrement('stock', $cartItem->quantity);
            }

            // Buat transaksi baru
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'pending', // Atau 'paid' jika ada simulasi pembayaran langsung
            ]);

            // Tambahkan item transaksi
            foreach ($transactionItemsData as $itemData) {
                $transaction->items()->create($itemData);
            }

            // Hapus item dari keranjang setelah checkout
            $user->carts()->delete();

            DB::commit();
            return redirect()->route('buyer.transactions.index')->with('success', 'Checkout berhasil! Transaksi Anda sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }
}