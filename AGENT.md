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

**Stack:** Laravel 12 + MySQL  
**PHP Version:** 8.3+  
**Node Version:** 20+

## Project Structure
```
project-root/
├── app/
│   ├── Models/          # Eloquent models
│   ├── Http/
│   │   ├── Controllers/ # Request handlers
│   │   ├── Requests/    # Form validation
│   │   └── Resources/   # API transformers
│   ├── Services/        # Business logic
│   └── Repositories/    # Data access layer (if used)
├── database/
│   ├── migrations/      # Database schema
│   └── seeders/         # Sample data
├── routes/
│   ├── web.php         # Web routes
│   └── api.php         # API routes
├── resources/
│   └── views/          # Blade templates
└── tests/              # PHPUnit tests
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
- [List specific Laravel 12 features you're using, e.g.:]
- Eloquent ORM with relationships
- Queue system for background jobs
- Event/Listener pattern
- Laravel Sanctum for API authentication
- Laravel Breeze/Jetstream for auth scaffolding

### Additional Packages
- [List Composer packages with their purpose:]
- `spatie/laravel-permission` - Role & permission management
- `laravel/telescope` - Debugging & monitoring (dev only)
- [Add others as needed]

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

### Creating a New Feature
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

// 3. Controller
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

---

**Last Updated:** [Date]  
**Instructions for AI:** When generating code, follow the patterns and conventions documented above. Always ask for clarification if business logic or requirements are unclear. Prioritize clean, maintainable code over clever solutions.