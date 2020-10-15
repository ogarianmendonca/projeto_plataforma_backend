<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = [
            'ADMINISTRADOR',
            'COORDENADOR'
        ];

        $user = auth('api')->user();
        $user->roles = $user['roles'];

        $userRoles = [];
        foreach ($user->roles as $role) {
            $userRoles[] = $role->name;
        }

        if (!array_intersect_assoc($roles, $userRoles)) {
            return response()->json(['message' => 'Não autorizado!'], 401);
        }

        return $next($request);
    }
}
