# AGENT.md - Project Context for AI Coding Assistant

## Project Overview
**Project Name:** RantauHub 

**Description:** 

**RantauHub** — a digital platform that connects **Minangkabau diaspora (perantau)** with **local SMEs (UMKM)** in West Sumatra for **mentorship, investment, and collaboration.**

The goal is to empower West Sumatra’s local economy through *“digital pulang basamo”* — bringing back the diaspora’s capital, knowledge, and network in a sustainable way.

The platform has three main user types:>

**UMKM (local SMEs):** who seek funding and mentorship.
**Mentors:** diaspora professionals who guide UMKM through expertise and *Bank Jam Mentor* (mentorship hour banking).
**Investors:** diaspora or local backers who fund projects and track impact.

(Optionally: **Admin / Platform provider** to manage users, analytics, and revenue model.)

**Stack:** Laravel 12 + Livewire + Volt + MySQL  
**PHP Version:** 8.3+  
**Node Version:** 20+

**UI Framework:** Livewire (Flux + Volt) for reactive components and routing
- Livewire views are stored in `resources/views/livewire/`
- Routes use `Volt::route()` for single-file Livewire components
- Traditional Blade views are in `resources/views/`

## Project Structure
```
project-root/
├── app/
│   ├── Models/          # Eloquent models
│   ├── Http/
│   │   ├── Controllers/ # Request handlers (minimal - prefer Livewire/Volt)
│   │   ├── Middleware/   # Custom middleware (role, type, etc.)
│   │   ├── Requests/    # Form validation
│   │   └── Resources/   # API transformers
│   ├── Services/        # Business logic
│   ├── Actions/         # Fortify actions, service actions
│   ├── Enums/           # PHP 8.3+ backed enums
│   └── Repositories/    # Data access layer (if used)
├── database/
│   ├── migrations/      # Database schema
│   └── seeders/         # Sample data
├── routes/
│   ├── web.php         # Web routes (uses Volt::route() for Livewire)
│   └── api.php         # API routes
├── resources/
│   ├── views/
│   │   ├── livewire/   # Livewire/Volt components (PRIMARY VIEW LOCATION)
│   │   ├── components/ # Blade components
│   │   └── layouts/    # Layout templates
│   └── css/            # Tailwind CSS
└── tests/              # Pest/PHPUnit tests
```

## Architecture & Conventions

### Code Style
- Follow PSR-12 coding standards
- Use strict types: `declare(strict_types=1);`
- Type hint everything (parameters, returns, properties)
- Use PHP 8.3+ features (readonly properties, enums, etc.)

### Naming Conventions
- **Models:** Singular PascalCase (e.g., `User`, `BlogPost`)
- **Controllers:** PascalCase with `Controller` suffix (e.g., `UserController`)
- **Methods:** camelCase (e.g., `getUserById()`)
- **Routes:** kebab-case (e.g., `/blog-posts`)
- **Database tables:** snake_case plural (e.g., `users`, `blog_posts`)
- **Variables:** camelCase (e.g., `$userName`)

### Model Conventions
- Use Eloquent relationships over manual queries
- Define `$fillable` or `$guarded` properties
- Use casts for date/JSON/boolean fields
- Add docblocks for IDE support

### Service Layer Pattern
- Complex business logic goes in Services (e.g., `app/Services/UserService.php`)
- Controllers should be thin - delegate to Services
- Services handle transactions and multiple model interactions

### Database
- Use migrations for all schema changes (never modify DB directly)
- Name migrations descriptively: `create_users_table`, `add_status_to_orders`
- Use foreign key constraints
- Index frequently queried columns
- Use soft deletes where appropriate

### Validation
- Use Form Requests for complex validation (e.g., `StoreUserRequest`)
- Keep simple validation in controllers: `$request->validate([...])`
- Custom validation rules in `app/Rules/`

### API Development
- Use API Resources for transforming responses
- Return consistent JSON structure: `{data: {}, meta: {}, errors: []}`
- HTTP status codes: 200 (OK), 201 (Created), 204 (No Content), 400 (Bad Request), 401 (Unauthorized), 404 (Not Found), 422 (Validation Error)

## Key Technologies & Packages

### Laravel 12 Features in Use
- Eloquent ORM with relationships
- Queue system for background jobs
- Event/Listener pattern
- Laravel Fortify for authentication (not Breeze/Jetstream)
- Middleware system for role and type-based access control

### Livewire & Volt (Primary UI Framework)
- **Livewire** (`livewire/livewire`) - Full-stack framework for Laravel
- **Livewire Flux** (`livewire/flux`) - UI component library
- **Livewire Volt** (`livewire/volt`) - Single-file components (like Inertia but for Livewire)
- **View Location:** All Livewire views are stored in `resources/views/livewire/`
- **Routing Pattern:** Use `Volt::route('path', 'livewire.component.name')` for single-file components
- **Component Pattern:** Single-file components combine PHP logic and Blade template in one file

### Additional Packages
- `laravel/fortify` - Authentication system (login, registration, password reset, 2FA)
- `pestphp/pest` - Testing framework
- `laravel/pint` - Code style fixer
- `laravel/pail` - Log streaming in development
- **Vite + Tailwind CSS v4 + DaisyUI** for frontend styling

### Theme & Design System (DaisyUI)
The application uses a custom DaisyUI theme with RantauHub brand colors:

**Color Palette:**
- **Primary (`#122937`)**: Dark blue/teal - used for main brand elements, headers, primary buttons, and backgrounds
- **Secondary (`#CEA761`)**: Gold - accent color for highlights, titles, progress bars, star ratings, and call-to-action buttons
- **Accent (`#925E25`)**: Darker gold/brown - tertiary color for additional accents and depth

**Usage in Components:**
- Primary buttons/links: `bg-primary text-primary-content`
- Secondary highlights: `bg-secondary text-secondary-content`
- Accent elements: `bg-accent text-accent-content`
- Backgrounds: `bg-base-100`, `bg-base-200`, `bg-base-300`
- Text: `text-base-content` (adapts to light/dark mode)

**Theme Configuration:**
- CSS theme variables defined in `resources/css/app.css` using Tailwind v4 `@theme` syntax
- DaisyUI theme configuration in `tailwind.config.js` with custom "rantauhub" theme
- Dark mode support with adjusted base colors
- Apply theme: `data-theme="rantauhub"` on root element or use DaisyUI's theme system

### View Architecture
- **Livewire Components:** `resources/views/livewire/*.blade.php` - Primary location for UI components
- **Blade Components:** `resources/views/components/*` - Reusable Blade components
- **Layouts:** `resources/views/layouts/*` - Layout templates
- **Regular Views:** `resources/views/*.blade.php` - Static Blade views

## Database Schema

### Key Tables
**users**
- `id` (bigint, PK)
- `name` (string)
- `email` (string, unique)
- `password` (string)
- `email_verified_at` (timestamp, nullable)
- `created_at`, `updated_at` (timestamps)

**[Add other important tables with key columns]**

### Relationships
- User hasMany Posts
- Post belongsTo User
- [Document other key relationships]

## Business Logic & Rules

### Authentication
- [Describe auth flow: session-based, token-based, OAuth, etc.]
- [Password requirements, email verification, etc.]

### Authorization
- [Role-based access control rules]
- [Permission structure]

### Key Business Rules
1. [Rule 1: e.g., "Orders cannot be cancelled after 24 hours"]
2. [Rule 2: e.g., "Users must verify email before accessing premium features"]
3. [Add specific business constraints]

## API Endpoints (if applicable)

### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout

### [Resource Name]
- `GET /api/resources` - List all
- `GET /api/resources/{id}` - Get single
- `POST /api/resources` - Create new
- `PUT /api/resources/{id}` - Update
- `DELETE /api/resources/{id}` - Delete

## Environment & Configuration

### Required ENV Variables
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Add other critical env vars
MAIL_MAILER=smtp
QUEUE_CONNECTION=redis
```

### Important Config Files
- `config/database.php` - Database connections
- `config/auth.php` - Authentication guards
- [List other modified config files]

## Testing Guidelines

### Test Structure
- Feature tests in `tests/Feature/` - test HTTP requests
- Unit tests in `tests/Unit/` - test individual methods
- Use factories for test data: `User::factory()->create()`

### Running Tests
```bash
php artisan test
php artisan test --filter UserTest
```

## Common Commands

### Development
```bash
php artisan serve              # Start dev server
php artisan migrate           # Run migrations
php artisan migrate:fresh --seed  # Fresh DB with seeds
php artisan make:model Post -mfc  # Model + migration + factory + controller
php artisan queue:work        # Process queue jobs
```

### Database
```bash
php artisan db:seed           # Run seeders
php artisan migrate:rollback  # Rollback last migration
php artisan tinker           # Interactive console
```

## Common Patterns & Examples

### Creating a Livewire/Volt Component

```php
// 1. Create view: resources/views/livewire/posts/create.blade.php
// OR create a Volt single-file component

// 2. Route in routes/web.php
use Livewire\Volt\Volt;

Volt::route('posts/create', 'posts.create')->name('posts.create');

// 3. Volt Single-File Component Example (resources/views/livewire/posts/create.blade.php)
<?php
use App\Models\Post;
use Livewire\Volt\Component;

new class extends Component {
    public string $title = '';
    public string $content = '';

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        auth()->user()->posts()->create($validated);
        
        $this->redirect(route('posts.index'));
    }
}; ?>

<div>
    <form wire:submit="save">
        <input type="text" wire:model="title" />
        <textarea wire:model="content"></textarea>
        <button type="submit">Create Post</button>
    </form>
</div>
```

### Creating a Traditional Feature (if not using Livewire)
```php
// 1. Migration
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->text('content');
    $table->timestamps();
});

// 2. Model
class Post extends Model {
    protected $fillable = ['title', 'content', 'user_id'];
    
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

// 3. Controller (prefer Livewire/Volt for most features)
class PostController extends Controller {
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        
        $post = auth()->user()->posts()->create($validated);
        
        return redirect()->route('posts.show', $post);
    }
}
```

## Gotchas & Important Notes

### Laravel 12 Specific
- [Note any Laravel 12 breaking changes or new patterns]
- [Configuration changes from previous versions]

### Project-Specific
- [Any quirks, workarounds, or important technical debt]
- [Third-party service integrations and their limitations]
- [Performance considerations]

## Current Focus & Priorities
[Update this section regularly with what you're currently working on]
- [ ] Feature: [Current feature being developed]
- [ ] Bug: [Known bugs being addressed]
- [ ] Refactor: [Code improvements needed]

## Questions to Ask Before Coding
1. Does this need a migration?
2. Should this logic be in a Service?
3. Do we need validation rules?
4. Are there existing helper methods I can use?
5. Does this need tests?
6. Will this impact existing features?
7. **Theme consistency:** Am I using the correct brand colors? (Primary: `#122937`, Secondary: `#CEA761`, Accent: `#925E25`)

---

**Last Updated:** [Date]  
**Instructions for AI:** When generating code, follow the patterns and conventions documented above. Always ask for clarification if business logic or requirements are unclear. Prioritize clean, maintainable code over clever solutions.