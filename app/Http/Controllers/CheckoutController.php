<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);

        return view('checkout.index', compact('cart'));
    }

    public function store(): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('success', 'Keranjang masih kosong.');
        }

        $order = DB::transaction(function () use ($cart) {
            $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'buyer_id' => auth()->id(),
                'total_price' => $total,
                'status' => 'paid',
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'seller_id' => $item['seller_id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Checkout berhasil.');
    }
}
