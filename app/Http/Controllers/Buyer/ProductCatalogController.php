<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->paginate(12);
        return view('buyer.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->stock === 0) {
            return redirect()->route('buyer.products.index')->with('error', 'Produk ini sedang tidak tersedia.');
        }
        return view('buyer.products.show', compact('product'));
    }
}