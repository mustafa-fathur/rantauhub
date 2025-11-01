<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        if (empty($roles)) {
            return $next($request);
        }

        // Handle comma-separated roles: 'role:admin,government'
        $allowedRoles = [];
        foreach ($roles as $role) {
            // Split by comma if multiple roles in one parameter
            $roleParts = explode(',', $role);
            foreach ($roleParts as $rolePart) {
                $rolePart = trim($rolePart);
                if (!empty($rolePart)) {
                    try {
                        $allowedRoles[] = UserRole::from($rolePart);
                    } catch (\ValueError $e) {
                        abort(500, "Invalid role: {$rolePart}");
                    }
                }
            }
        }

        if (! in_array($userRole, $allowedRoles, true)) {
            $roleNames = array_map(fn(UserRole $r) => $r->value, $allowedRoles);
            abort(403, 'Unauthorized. Required role: ' . implode(', ', $roleNames));
        }

        return $next($request);
    }
}
