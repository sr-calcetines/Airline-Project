<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if ($role === 'admin' && (!$user || !$user->isAdmin)) {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        if ($role === 'user' && !$user) {
            return redirect('/login')->with('error', 'Debes iniciar sesión.');
        }

        return $next($request);
    }
}
