# Middleware Usage Guide

This guide explains how to use the role and type middleware to protect routes and differentiate views.

## Middleware Overview

We have two middleware:
1. **`role`** - Checks user role (admin, user, government)
2. **`type`** - Checks user type (umkm_owner, mentor, funder)

## Route Protection

### Using Role Middleware

Protect routes by role:

```php
// Single role
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin only routes
});

// Multiple roles (admin OR government) - comma-separated
Route::middleware(['auth', 'role:admin,government'])->group(function () {
    // Admin or Government routes
});

// Multiple roles - separate middleware calls
Route::middleware(['auth', 'role:admin', 'role:government'])->group(function () {
    // Admin or Government routes (same as above)
});

// In route definition
Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');
```

### Using Type Middleware

Protect routes by user type:

```php
// Single type
Route::middleware(['auth', 'type:umkm_owner'])->group(function () {
    // UMKM Owner only routes
});

// Multiple types (mentor OR funder) - comma-separated
Route::middleware(['auth', 'type:mentor,funder'])->group(function () {
    // Mentor or Funder routes
});

// Multiple types - separate middleware calls
Route::middleware(['auth', 'type:mentor', 'type:funder'])->group(function () {
    // Mentor or Funder routes (same as above)
});

// In route definition
Route::get('/mentor/sessions', [MentorSessionController::class, 'index'])
    ->middleware(['auth', 'type:mentor'])
    ->name('mentor.sessions.index');
```

### Combining Middleware

```php
// User must be authenticated, have admin role, AND be a mentor type
Route::middleware(['auth', 'role:admin', 'type:mentor'])->group(function () {
    // Admin mentors only
});
```

## View Differentiation

All views automatically receive these variables:

- `$userRole` - The user's role enum (UserRole::ADMIN, UserRole::USER, etc.)
- `$userType` - The user's type enum (UserType::UMKM_OWNER, UserType::MENTOR, etc.)
- `$isAdmin` - Boolean indicating if user is admin
- `$isGovernment` - Boolean indicating if user is government

### Blade Examples

```blade
{{-- Check if user is admin --}}
@if($isAdmin)
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
@endif

{{-- Check user role --}}
@if($userRole === \App\Enums\UserRole::ADMIN)
    <div class="admin-panel">Admin Panel</div>
@endif

{{-- Check user type --}}
@if($userType === \App\Enums\UserType::MENTOR)
    <a href="{{ route('mentor.dashboard') }}">Mentor Dashboard</a>
@endif

{{-- Show different content based on role --}}
@switch($userRole)
    @case(\App\Enums\UserRole::ADMIN)
        <div>Admin Content</div>
        @break
    @case(\App\Enums\UserRole::GOVERNMENT)
        <div>Government Content</div>
        @break
    @default
        <div>Regular User Content</div>
@endswitch

{{-- Conditional rendering --}}
@auth
    @if($isAdmin)
        <li><a href="/admin">Admin</a></li>
    @endif
    
    @if($userType === \App\Enums\UserType::UMKM_OWNER)
        <li><a href="/umkm/dashboard">My UMKM</a></li>
    @endif
@endauth
```

## Model Helper Methods

The User model provides helpful methods:

```php
// Check role
$user->hasRole(UserRole::ADMIN);
$user->hasAnyRole(UserRole::ADMIN, UserRole::GOVERNMENT);
$user->isAdmin();
$user->isGovernment();
$user->isRegularUser();

// Check type
$user->getUserType(); // Returns UserType enum or null
$user->hasType(UserType::MENTOR);
```

### In Controllers

```php
public function index()
{
    if (!auth()->user()->isAdmin()) {
        abort(403);
    }
    
    // Or use the middleware instead
}
```

## Examples in Routes File

See `routes/web.php` for complete examples of:
- Admin-only routes
- Government-only routes  
- UMKM owner routes
- Mentor routes
- Funder routes

## Error Handling

If a user tries to access a route without the required role/type, they will receive a 403 Forbidden error with the message:

```
Unauthorized. Required role: admin
```

or

```
Unauthorized. Required user type: mentor
```

## Notes

- User type is determined by which profile exists (mentor, funder, or umkm_owner relationship)
- A user can only have ONE type at a time
- A user can only have ONE role (stored in users.role)
- Middleware checks happen after authentication, so use with `auth` middleware

