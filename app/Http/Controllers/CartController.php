<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return Cart::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:custom_user,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer'
        ]);

        return Cart::create($validated);
    }

    public function show($id)
    {
        return Cart::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return $cart;
    }

    public function destroy($id)
    {
        return Cart::destroy($id);
    }
}
