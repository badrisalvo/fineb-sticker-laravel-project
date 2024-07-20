<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();


        if ($user && $user->role === $role) {

            return $next($request);
        }

        if ($user && $user->role === 'admin') {
            return redirect()->route('merek.index'); 
        } 
        elseif ($user && $user->role === 'user') {
            return redirect()->route('home');
        }

        abort(403, 'Unauthorized action.');
    }
}

 
