<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ForumController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\MyUmkmController;
use App\Http\Controllers\User\FundingRequestController;
use App\Http\Controllers\User\MentorRegistrationController;
use App\Http\Controllers\User\FunderRegistrationController;
use App\Http\Controllers\User\FunderFundingController;
use App\Http\Controllers\User\MentoringController;
use App\Http\Controllers\User\MenteeController;
use App\Http\Controllers\Public\UmkmController;
use App\Http\Controllers\Public\MentorController;
use App\Http\Controllers\Public\ForumController as PublicForumController;

// Main Pages

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.detail');

Route::get('/mentor', [MentorController::class, 'index'])->name('mentor');
Route::get('/mentor/{id}', [MentorController::class, 'show'])->name('mentor.detail');

Route::get('/forum', [PublicForumController::class, 'index'])->name('forum');
Route::get('/forum/{id}', [PublicForumController::class, 'show'])->name('forum.detail');

Route::get('/about', function () {
    return view('about');
})->name('about');


// Auth Routes

// User routes - For users with role "user"
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user/dashboard', [DashboardController::class, 'index']);
    Route::get('user/forum-saya', [ForumController::class, 'index'])->name('my-forum');
    Route::get('user/profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::put('user/profile', [ProfileController::class, 'update'])->name('my-profile.update');
    
    // Registration Routes (UMKM, Mentor & Funder)
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('umkm-owner', [RegisterController::class, 'showUmkmOwnerForm'])->name('umkm-owner');
        Route::post('umkm-owner', [RegisterController::class, 'storeUmkmOwner'])->name('umkm-owner.store');
        Route::get('umkm-business', [RegisterController::class, 'showUmkmBusinessForm'])->name('umkm-business');
        Route::post('umkm-business', [RegisterController::class, 'storeUmkmBusiness'])->name('umkm-business.store');
        Route::get('mentor', [MentorRegistrationController::class, 'showForm'])->name('mentor');
        Route::post('mentor', [MentorRegistrationController::class, 'store'])->name('mentor.store');
        Route::get('funder', [FunderRegistrationController::class, 'showForm'])->name('funder');
        Route::post('funder', [FunderRegistrationController::class, 'store'])->name('funder.store');
    });
    
    // UMKM Management Routes (check in controller if user has umkmOwner profile)
    Route::prefix('user')->name('my-umkm.')->group(function () {
        Route::get('umkm-saya', [MyUmkmController::class, 'index'])->name('index');
        Route::get('umkm-saya/{id}/edit', [MyUmkmController::class, 'edit'])->name('edit');
        Route::put('umkm-saya/{id}', [MyUmkmController::class, 'update'])->name('update');
        Route::delete('umkm-saya/{id}', [MyUmkmController::class, 'destroy'])->name('destroy');
    });
    
    // Funding Request Routes (check in controller if user has umkmOwner profile)
    Route::prefix('user')->name('funding-requests.')->group(function () {
        Route::get('funding-requests', [FundingRequestController::class, 'index'])->name('index');
        Route::get('funding-requests/create', [FundingRequestController::class, 'create'])->name('create');
        Route::post('funding-requests', [FundingRequestController::class, 'store'])->name('store');
        Route::get('funding-requests/{id}', [FundingRequestController::class, 'show'])->name('show');
        Route::put('funding-requests/{id}/cancel', [FundingRequestController::class, 'cancel'])->name('cancel');
    });
    
    // Mentoring Routes (check in controller if user has umkmOwner profile)
    Route::prefix('user')->name('mentoring.')->group(function () {
        Route::get('mentoring', [MentoringController::class, 'index'])->name('index');
        Route::get('mentoring/create', [MentoringController::class, 'create'])->name('create');
        Route::post('mentoring', [MentoringController::class, 'store'])->name('store');
        Route::get('mentoring/{id}', [MentoringController::class, 'show'])->name('show');
        Route::post('mentoring/{id}/rate', [MentoringController::class, 'rate'])->name('rate');
        Route::delete('mentoring/{id}', [MentoringController::class, 'cancel'])->name('cancel');
    });
    
    // Multi-role routes - accessible if user has the corresponding profile (checked in controllers)
    // Mentee Routes (for mentors - check in controller if user has mentor profile)
    Route::prefix('mentee')->name('mentee.')->group(function () {
        Route::get('/', [MenteeController::class, 'index'])->name('index');
        Route::get('sessions/{id}', [MenteeController::class, 'show'])->name('show');
        Route::post('sessions/{id}/approve', [MenteeController::class, 'approve'])->name('approve');
        Route::post('sessions/{id}/reject', [MenteeController::class, 'reject'])->name('reject');
        Route::post('sessions/{id}/complete', [MenteeController::class, 'complete'])->name('complete');
    });
    
    // Funder Funding Routes (for funders - check in controller if user has funder profile)
    Route::prefix('funder')->name('funder.')->group(function () {
        Route::prefix('funding-requests')->name('funding-requests.')->group(function () {
            Route::get('/', [FunderFundingController::class, 'index'])->name('index');
            Route::get('{id}', [FunderFundingController::class, 'show'])->name('show');
            Route::post('{id}/accept', [FunderFundingController::class, 'accept'])->name('accept');
        });
    });
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