<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfessorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->user_type !== 'professor') {
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        return $next($request);
    }
}