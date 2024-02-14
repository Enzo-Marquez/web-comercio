<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario tiene el rol 'moderator'
        if ($request->user() && $request->user()->user_type === 'moderator') {
            return $next($request);
        }

        // Si no es un moderador, puedes personalizar el mensaje de error
        abort(Response::HTTP_UNAUTHORIZED, 'Acceso no autorizado. No tienes permiso para acceder a esta página como moderador.');
    }
}
