<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $search = request('search');
    $products = Product::with('categories')
        ->when($search, function ($query, $search) {
            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

    return view('welcome', [
        'products' => $products,
        'search' => $search,
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', function () {
        $search = request('search');
        $products = Product::with('categories')
            ->when($search, function ($query, $search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('welcome', [
            'products' => $products,
            'search' => $search,
        ]);
    })->middleware('role:user,admin')->name('products.index');

    Route::middleware('role:user,admin')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
        Route::post('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');
    });

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            Route::resource('products', ProductController::class);
        });
});

require __DIR__.'/auth.php';
