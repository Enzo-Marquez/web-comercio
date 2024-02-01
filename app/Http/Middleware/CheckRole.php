<?php

// app/Http/Middleware/CheckUserRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserType;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $allowedRoles = UserType::forMigration();

        // Verifica si el tipo de usuario actual está en los roles permitidos
        if (in_array($request->user()->user_type, $allowedRoles) && $request->user()->user_type === $role) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado.');
    }
}
