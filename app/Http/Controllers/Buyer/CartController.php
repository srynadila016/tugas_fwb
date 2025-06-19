<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        $totalPrice = $cartItems->sum(function($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });
        return view('buyer.cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        if (!$product || $product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => 0] // Initialize quantity if new
        );

        // Check if adding more quantity exceeds stock
        if (($cart->quantity + $request->quantity) > $product->stock) {
            return back()->with('error', 'Penambahan ke keranjang melebihi stok yang tersedia.');
        }

        $cart->quantity += $request->quantity;
        $cart->save();

        return redirect()->route('buyer.cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = Cart::where('user_id', Auth::id())->find($request->cart_id);

        if (!$cart) {
            return back()->with('error', 'Item keranjang tidak ditemukan.');
        }

        $product = $cart->product;
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Jumlah yang diminta melebihi stok produk ' . $product->name . '.');
        }

        if ($request->quantity === 0) {
            $cart->delete();
            return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui.');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cart->delete();
        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}