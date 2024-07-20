<?php

namespace App\Http\Middleware;

use Closure;

class GuestMiddleware
{
    public function handle($request, Closure $next)
    {
        // Jika user belum login, izinkan akses
        if (!Auth::check()) {
            return $next($request);
        }

        // Jika user sudah login, arahkan ke home atau halaman lain
        return redirect()->route('home');
    }
}
