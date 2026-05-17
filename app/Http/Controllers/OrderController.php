<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()->orders()->with('items')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        if ((int) $order->buyer_id !== (int) auth()->id()) {
            abort(403);
        }

        $order->load('items.seller');

        return view('orders.show', compact('order'));
    }
}
