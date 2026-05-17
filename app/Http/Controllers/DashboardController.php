<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        return $request->user()->role === 'seller'
            ? redirect()->route('seller.dashboard')
            : redirect()->route('buyer.dashboard');
    }

    public function seller(Request $request): View
    {
        $products = Product::with('categories')
            ->where('seller_id', $request->user()->id)
            ->latest()
            ->get();

        return view('dashboard', [
            'products' => $products,
            'totalProducts' => $products->count(),
            'totalStock' => $products->sum('stok'),
            'totalSales' => Order::whereHas('items', fn ($query) => $query->where('seller_id', $request->user()->id))->count(),
            'latestProducts' => $products->take(5),
        ]);
    }

    public function buyer(Request $request): View
    {
        return view('dashboard', [
            'products' => Product::with('seller')->latest()->take(12)->get(),
            'orders' => $request->user()->orders()->with('items')->latest()->take(5)->get(),
            'user' => $request->user(),
        ]);
    }
}
