<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()?->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index() {
        $products = Product::with('categories')->where('user_id', auth()->id())->get();
        return view('admin.products.index', compact('products')); // [cite: 41]
    }

    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories')); // [cite: 42]
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ]);

        $product = auth()->user()->products()->create($request->only('name', 'price'));
        $product->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product) {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories')); // [cite: 43]
    }

    public function update(Request $request, Product $product) {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ]);

        $product->update($request->only('name', 'price'));
        $product->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product) {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $product->delete(); // [cite: 44]
        return redirect()->route('admin.products.index');
    }
}
