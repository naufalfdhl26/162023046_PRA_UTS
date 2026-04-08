<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Halaman Utama / Landing Page (Menampilkan seluruh produk) [cite: 47, 48]
Route::get('/', function () {
    $products = Product::with('categories')->get(); // [cite: 49]
    return view('welcome', compact('products'));
})->name('home');

// Logika Redirect setelah Login
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.products.index'); // [cite: 36]
    }
    return redirect()->route('home'); // [cite: 37]
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Admin (ProductController) [cite: 39, 40]
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.products.index');
    })->name('home');

    Route::resource('products', ProductController::class)->except(['show']); // CRUD Produk [cite: 61]
});

// Route User (Fitur Keranjang / CartController) [cite: 50, 57]
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // [cite: 53]
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add'); // [cite: 52]
Route::post('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove'); // [cite: 54]

require __DIR__.'/auth.php';