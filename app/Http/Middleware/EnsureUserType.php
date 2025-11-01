<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$types
     */
    public function handle(Request $request, Closure $next, string ...$types): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userType = $request->user()->getUserType();

        if (empty($types)) {
            return $next($request);
        }

        // Handle comma-separated types: 'type:mentor,funder'
        $allowedTypes = [];
        foreach ($types as $type) {
            // Split by comma if multiple types in one parameter
            $typeParts = explode(',', $type);
            foreach ($typeParts as $typePart) {
                $typePart = trim($typePart);
                if (!empty($typePart)) {
                    try {
                        $allowedTypes[] = UserType::from($typePart);
                    } catch (\ValueError $e) {
                        abort(500, "Invalid user type: {$typePart}");
                    }
                }
            }
        }

        if (! $userType || ! in_array($userType, $allowedTypes, true)) {
            $typeNames = array_map(fn(UserType $t) => $t->value, $allowedTypes);
            abort(403, 'Unauthorized. Required user type: ' . implode(', ', $typeNames));
        }

        return $next($request);
    }
}
