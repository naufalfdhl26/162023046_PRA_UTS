<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BuyerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->role !== 'buyer') {
            abort(403, 'Halaman ini hanya untuk buyer.');
        }

        return $next($request);
    }
}
