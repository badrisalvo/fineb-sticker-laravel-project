<?php

namespace App\Http\Middleware;

use Closure; // Pastikan ini sudah diimpor

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Implementasi kode middleware Anda

        return parent::handle($request, $next, ...$guards);
    }
}
