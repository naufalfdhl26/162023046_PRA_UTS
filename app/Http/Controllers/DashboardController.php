<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return view('dashboard', [
                'totalProducts' => Product::count(),
                'totalUsers' => User::where('role', 'user')->count(),
                'latestProducts' => Product::latest()->take(5)->get(),
            ]);
        }

        return view('dashboard', [
            'products' => Product::latest()->get(),
            'user' => $user,
        ]);
    }
}
