<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Usa Auth::user() en lugar de auth()->user()
        // 🚨 OJO: Verifica si en tu BD el campo se llama 'nombre' o 'name'
        if (!Auth::check() || Auth::user()->role->nombre !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
