## RantauHub — Quick AI coding instructions

Purpose: give an AI coding agent the concrete, repo-specific knowledge needed to be immediately productive.

- Big picture: Laravel 12 application using Livewire (flux + volt) for UI, Laravel Fortify for auth, Pest for tests, Vite + Tailwind for frontend assets. Key folders: `app/` (models, controllers, services), `routes/` (see `routes/web.php`), `resources/views/livewire/` (Livewire views), `database/migrations`.

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
  - Route -> Livewire view example (from `routes/web.php`):
    ```php
    Route::get('/', fn() => view('livewire.home'))->name('home');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    ```
  - Controller -> Service pattern: controllers call `app/Services/*` methods and services handle transactions and multi-model logic.

- Integration points & external packages to be aware of:
  - `livewire/flux` and `livewire/volt` (UI routing and components)
  - `laravel/fortify` (auth flows under `app/Actions/Fortify`)
  - Vite + Tailwind + DaisyUI for frontend
  - `laravel/pail` used in development scripts for log streaming

- When making changes, check these files first to avoid surprises:
  - `composer.json` (scripted flows)
  - `phpunit.xml` (test env variables)
  - `routes/web.php` (route conventions for Livewire/Volt)

- Quick checklist for PRs/changes:
  1. Does it require a migration? If yes, add one and update `database/migrations`.
  2. Should logic live in `app/Services` or be inside a Controller? Prefer Service for multi-model logic.
  3. Add/adjust tests (Pest) using factories and ensure `php artisan test` passes locally.
  4. Run `npm run build` if frontend changes affect assets, and mention any env vars required.

If anything in this summary looks incomplete or you want me to include snippets from other files (for example `app/Actions/Fortify/*` or specific Livewire components), tell me which files and I'll merge them into this guidance.
