<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario tiene el rol 'admin'
        if ($request->user() && $request->user()->user_type === 'admin') {
            return $next($request);
        }

        // Si no es un administrador, puedes personalizar el mensaje de error
        abort(Response::HTTP_UNAUTHORIZED, 'Acceso no autorizado. No tienes permiso para acceder a esta página.');
    }
}

