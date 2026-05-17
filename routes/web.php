<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketplaceController::class, 'index'])->name('home');
Route::get('/products', [MarketplaceController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [MarketplaceController::class, 'show'])->name('products.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('seller')
        ->name('seller.')
        ->middleware('seller')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'seller'])->name('dashboard');
            Route::resource('products', ProductController::class);
        });

    Route::prefix('buyer')
        ->name('buyer.')
        ->middleware('buyer')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'buyer'])->name('dashboard');
        });

    Route::middleware('buyer')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.add');
        Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    Route::redirect('/admin/products', '/seller/products')->name('admin.products.index');
});

require __DIR__.'/auth.php';
