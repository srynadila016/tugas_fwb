<?php

namespace App\Http\Controllers\Buyer; // Namespace yang benar untuk controller ini

use App\Http\Controllers\Controller;
use App\Models\Product; // Import model Product
use Illuminate\Http\Request; // Digunakan jika ada input request di method lain
use Illuminate\Support\Str; // Opsional: jika Anda menggunakan Str::limit di view dan belum ada


class ProductController extends Controller
{
    /**
     * Display a listing of products for the buyer.
     * Mengambil daftar semua produk dan menampilkannya dengan pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(12);

        // Mengirimkan data produk ke view 'buyer.products.index'
        return view('buyer.products.index', compact('products'));
    }

    /**
     * Display the specified product details for the buyer.
     * Mengambil detail satu produk berdasarkan ID atau slug (melalui Route Model Binding).
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
       
        return view('buyer.products.show', compact('product'));
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan untuk fungsionalitas pembeli,
    // seperti addToCart, filterProducts, dll.
    // Contoh placeholder untuk addToCart (Anda perlu mengimplementasikan logika keranjang belanja):
    /*
    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1); // Ambil kuantitas dari request, default 1

        // TODO: Tambahkan logika untuk menyimpan produk ke keranjang belanja pengguna.
        // Ini bisa menggunakan session, database (model CartItem), atau package keranjang belanja.
        // Contoh sederhana (bukan implementasi penuh):
        // session()->push('cart', ['product_id' => $product->id, 'quantity' => $quantity, 'price' => $product->price]);

        return redirect()->back()->with('success', $product->name . ' berhasil ditambahkan ke keranjang!');
    }
    */
}