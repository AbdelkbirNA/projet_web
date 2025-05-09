<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Ne pas rediriger si la requête attend une réponse JSON
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Already authenticated.'], 200);
                }
                
                // Ne pas rediriger si on est sur une page spécifique comme /abdo
                $currentPath = $request->path();
                if (in_array($currentPath, ['abdo', 'professors', 'Ensiasd/Main'])) {
                    return $next($request);
                }
                
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}