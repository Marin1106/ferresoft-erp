<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |------------------------------------------------------------------
        | VALIDAR ADMIN
        |------------------------------------------------------------------
        */

        if (auth()->check() && auth()->user()->role === 'admin') {

            return $next($request);

        }

        /*
        |------------------------------------------------------------------
        | SI NO ES ADMIN
        |------------------------------------------------------------------
        */

        abort(403, 'Acceso no autorizado');

    }
}