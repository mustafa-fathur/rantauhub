## RantauHub — Quick AI coding instructions

Purpose: give an AI coding agent the concrete, repo-specific knowledge needed to be immediately productive.

- **Big picture:** Laravel 12 application using **Livewire (Flux + Volt)** for UI, Laravel Fortify for auth, Pest for tests, Vite + Tailwind for frontend assets. 
- **Important:** This project uses Livewire and Volt as the primary UI framework. All Livewire views are stored in `resources/views/livewire/` directory.
- **Key folders:** 
  - `app/` (models, controllers, services, middleware, enums)
  - `routes/` (see `routes/web.php` for Volt routing patterns)
  - `resources/views/livewire/` (PRIMARY LOCATION for Livewire/Volt components)
  - `database/migrations`

- Important files to read first:
  - `AGENT.md` (project overview and conventions)
  - `composer.json` (setup/dev/test scripts)
  - `routes/web.php` (shows Livewire/Volt route patterns)
  - `phpunit.xml` (test env: sqlite in-memory, sync queue)
  - `app/Actions/Fortify/`, `app/Providers/FortifyServiceProvider.php` (auth flows)

- Project conventions (concrete):
  - PSR-12 + `declare(strict_types=1)` used across PHP files.
  - Keep controllers thin; place business logic in `app/Services` or `app/Actions`.
  - Use Form Requests for complex validation (see `app/Http/Requests/`).
  - Eloquent models: singular PascalCase, define `$fillable`/casts, use relationships.
  - Livewire views live under `resources/views/livewire/*` and routes often use `Volt::route()` (see `routes/web.php`).

- Developer workflows (exact commands):
  - Full setup: `composer run setup` (copies .env, installs deps, generates key, migrates, npm install, builds assets).
  - Dev (concurrent): `composer run dev` (uses `npx concurrently` to run dev server, queue listener, pail logs, and vite dev). Alternatively run pieces manually:
    - `php artisan serve`
    - `npm run dev`
    - `php artisan queue:listen` (or `queue:work` in prod-like runs)
  - Run tests: `composer run test` or `php artisan test` (phpunit.xml config uses sqlite :memory: for fast isolated tests).
  - Build assets: `npm run build` (Vite/Tailwind)
  - Code style: `vendor/bin/pint` is available (pint is included as dev dependency).

- Testing & CI notes (project-specific):
  - `phpunit.xml` enforces `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` for CI. Tests expect sync queues and array cache/session drivers.
  - Use model factories (`database/factories/`) and Pest-style tests (see `tests/Pest.php`).

- Patterns and examples to follow (copyable):
  - **Livewire/Volt Routing** (from `routes/web.php`):
    ```php
    // Regular route to Livewire view
    Route::get('/', fn() => view('livewire.home'))->name('home');
    
    // Volt single-file component route (RECOMMENDED)
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    
    // With middleware
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Volt::route('admin/users', 'admin.users.index')->name('admin.users.index');
    });
    ```
  - **Livewire View Location:** All Livewire components must be in `resources/views/livewire/`
    - Example: `Volt::route('posts/create', 'posts.create')` expects `resources/views/livewire/posts/create.blade.php`
  - Controller -> Service pattern: Prefer Livewire/Volt for most features. For API or complex logic, controllers call `app/Services/*` methods and services handle transactions and multi-model logic.

- Integration points & external packages to be aware of:
  - **`livewire/livewire`** - Core Livewire framework (reactive components)
  - **`livewire/flux`** - UI component library for Livewire
  - **`livewire/volt`** - Single-file components (combines PHP class + Blade in one file)
    - All Volt components live in `resources/views/livewire/`
  - **`laravel/fortify`** - Authentication system (not Breeze/Jetstream)
    - Auth flows under `app/Actions/Fortify/`
    - Views configured in `app/Providers/FortifyServiceProvider.php`
  - **Vite + Tailwind CSS v4 + DaisyUI** - Frontend build tool and CSS framework
    - **Theme:** Custom RantauHub theme with colors `#122937` (primary), `#CEA761` (secondary), `#925E25` (accent)
    - **Theme config:** `resources/css/app.css` (CSS variables) and `tailwind.config.js` (DaisyUI theme)
    - **Usage:** Use DaisyUI classes (`btn-primary`, `bg-secondary`, etc.) or Tailwind utilities (`bg-primary`, `text-secondary-content`)
  - **`laravel/pail`** - Log streaming in development scripts

- When making changes, check these files first to avoid surprises:
  - `composer.json` (scripted flows)
  - `phpunit.xml` (test env variables)
  - `routes/web.php` (route conventions for Livewire/Volt)

- Quick checklist for PRs/changes:
  1. Does it require a migration? If yes, add one and update `database/migrations`.
  2. **Is this a UI feature?** Prefer Livewire/Volt component over traditional Controller+View. Place in `resources/views/livewire/`.
  3. Should logic live in `app/Services` or be inside a Controller/Livewire component? Prefer Service for multi-model logic.
  4. Add/adjust tests (Pest) using factories and ensure `php artisan test` passes locally.
  5. Run `npm run build` if frontend changes affect assets, and mention any env vars required.
  6. **Remember:** Livewire views go in `resources/views/livewire/`, not `resources/views/` directly.
  7. **Theme consistency:** Use DaisyUI theme colors (primary: `#122937`, secondary: `#CEA761`, accent: `#925E25`). Use `bg-primary`, `text-secondary`, `btn-accent` classes or DaisyUI component classes.

If anything in this summary looks incomplete or you want me to include snippets from other files (for example `app/Actions/Fortify/*` or specific Livewire components), tell me which files and I'll merge them into this guidance.
