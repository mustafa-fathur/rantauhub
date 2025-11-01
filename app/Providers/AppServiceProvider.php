<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share user role and type with all views
        View::composer('*', function ($view): void {
            $user = auth()->user();
            
            $view->with([
                'userRole' => $user?->role,
                'userType' => $user?->getUserType(),
                'isAdmin' => $user?->isAdmin() ?? false,
                'isGovernment' => $user?->isGovernment() ?? false,
            ]);
        });
    }
}
