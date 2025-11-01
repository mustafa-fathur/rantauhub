<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('livewire.main.home');
})->name('home');

Route::get('/about', function () {
    return view('livewire.main.about');
})->name('about');



// Auth Routes

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin routes - only accessible by admin role
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Example admin routes
    // Volt::route('users', 'admin.users.index')->name('users.index');
    // Volt::route('verifications', 'admin.verifications.index')->name('verifications.index');
});

// Government routes - only accessible by government role
Route::middleware(['auth', 'role:government'])->prefix('government')->name('government.')->group(function () {
    // Example government routes
    // Volt::route('dashboard', 'government.dashboard')->name('dashboard');
});

// User type specific routes
Route::middleware(['auth', 'type:umkm_owner'])->prefix('umkm')->name('umkm.')->group(function () {
    // Example UMKM owner routes
    // Volt::route('dashboard', 'umkm.dashboard')->name('dashboard');
    // Volt::route('businesses', 'umkm.businesses.index')->name('businesses.index');
});

Route::middleware(['auth', 'type:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    // Example Mentor routes
    // Volt::route('dashboard', 'mentor.dashboard')->name('dashboard');
    // Volt::route('sessions', 'mentor.sessions.index')->name('sessions.index');
});

Route::middleware(['auth', 'type:funder'])->prefix('funder')->name('funder.')->group(function () {
    // Example Funder routes
    // Volt::route('dashboard', 'funder.dashboard')->name('dashboard');
    // Volt::route('fundings', 'funder.fundings.index')->name('fundings.index');
});

// Regular authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

