<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ForumController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\MyUmkmController;

// Main Pages

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/umkm', function () {
    return view('umkm');
})->name('umkm');

Route::get('/mentor', function () {
    return view('mentor');
})->name('mentor');

Route::get('/forum', function () {
    return view('forum');
})->name('forum');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/umkm/detail', function () {
    return view('umkm-detail');
})->name('umkm.detail');

Route::get('/mentor/detail', function () {
    return view('mentor-detail');
})->name('mentor.detail');

Route::get('/forum/detail', function () {
    return view('forum-detail');
})->name('forum.detail');


// Auth Routes

// User routes - For users with role "user"
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user/dashboard', [DashboardController::class, 'index']);
    Route::get('user/forum-saya', [ForumController::class, 'index'])->name('my-forum');
    Route::get('user/profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::put('user/profile', [ProfileController::class, 'update'])->name('my-profile.update');
    
    // UMKM Registration Routes
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('umkm-owner', [RegisterController::class, 'showUmkmOwnerForm'])->name('umkm-owner');
        Route::post('umkm-owner', [RegisterController::class, 'storeUmkmOwner'])->name('umkm-owner.store');
        Route::get('umkm-business', [RegisterController::class, 'showUmkmBusinessForm'])->name('umkm-business');
        Route::post('umkm-business', [RegisterController::class, 'storeUmkmBusiness'])->name('umkm-business.store');
    });
    
    // UMKM Management Routes (only for UMKM Owners)
    Route::middleware(['auth', 'type:umkm_owner'])->prefix('user')->name('my-umkm.')->group(function () {
        Route::get('umkm-saya', [MyUmkmController::class, 'index'])->name('index');
        Route::get('umkm-saya/{id}/edit', [MyUmkmController::class, 'edit'])->name('edit');
        Route::put('umkm-saya/{id}', [MyUmkmController::class, 'update'])->name('update');
        Route::delete('umkm-saya/{id}', [MyUmkmController::class, 'destroy'])->name('destroy');
    });
});

// User type specific routes
Route::middleware(['auth', 'type:umkm_owner'])->prefix('umkm')->name('umkm.')->group(function () {
    // Volt::route('tambah-umkm', 'umkm-owner.add-umkm')->name('add-umkm');
    // Volt::route('umkm-saya', 'umkm-owner.my-umkm')->name('my-umkm');
    // Volt::route('umkm/saya/{id}', 'umkm-owner.my-umkm-detail')->name('my-umkm.detail');
});

Route::middleware(['auth', 'type:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    // Example Mentor routes
    // Volt::route('mentoring', 'mentor.mentoring')->name('mentoring');
});

Route::middleware(['auth', 'type:funder'])->prefix('funder')->name('funder.')->group(function () {
    // Example Funder routes
    // Volt::route('pendanaan', 'funder.funding')->name('funding');
});

// Volt sheep

// Admin routes - only accessible by admin role
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Admin Dashboard (with prefix)
    Route::prefix('admin')->name('admin.')->group(function () {
        Volt::route('dashboard', 'admin.dashboard')->name('dashboard');
        Volt::route('verifikasi-umkm', 'admin.verify-umkm')->name('verify-umkm');
        Volt::route('verifikasi-mentor', 'admin.verify-mentor')->name('verify-mentor');
        Volt::route('verifikasi-funder', 'admin.verify-funder')->name('verify-funder');
        Volt::route('kategori-forum', 'admin.forum-category')->name('forum-category');
        Volt::route('verifikasi-pendanaan', 'admin.verify-funding')->name('verify-funding');
    });


    // Admin Settings (using default Laravel Starter Kit layout)
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