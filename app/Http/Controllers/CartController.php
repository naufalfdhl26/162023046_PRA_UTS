<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function store(Product $product): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'seller_id' => $product->seller_id,
                'name' => $product->nama_produk,
                'quantity' => 1,
                'price' => $product->harga,
                'image' => $product->gambar,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk masuk keranjang.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $validated['quantity'];
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Quantity berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
