<?php

namespace App\Http\Responses;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('home');
        }

        // Check if redirect parameter exists (from modal login)
        $redirect = $request->input('redirect');
        if ($redirect) {
            // Handle both absolute and relative URLs
            if (filter_var($redirect, FILTER_VALIDATE_URL)) {
                // Validate that redirect is within our domain for security
                $parsedUrl = parse_url($redirect);
                $appUrl = parse_url(config('app.url'));
                
                if (($parsedUrl['host'] ?? '') === ($appUrl['host'] ?? '') || 
                    ($parsedUrl['host'] ?? '') === request()->getHost()) {
                    return redirect($redirect);
                }
            } else {
                // Relative URL - redirect directly (Laravel will handle security)
                return redirect($redirect);
            }
        }

        // Redirect based on role
        return match ($user->role) {
            UserRole::ADMIN => redirect()->route('admin.dashboard'),
            UserRole::GOVERNMENT => redirect()->route('government.dashboard'),
            default => redirect()->route('dashboard'), // For regular users (role: user)
        };
    }
}

