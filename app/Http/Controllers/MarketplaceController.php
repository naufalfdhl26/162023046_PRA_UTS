<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketplaceController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $products = Product::with('seller')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_produk', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('welcome', compact('products', 'search'));
    }

    public function show(Product $product): View
    {
        $product->load('seller', 'categories');

        return view('products.show', compact('product'));
    }
}
