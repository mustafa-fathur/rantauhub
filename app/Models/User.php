<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_photo',
        'bio',
        'role',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    /**
     * Get the user's documents
     */
    public function documents(): HasMany
    {
        return $this->hasMany(UserDocument::class);
    }

    /**
     * Get the user's mentor profile
     */
    public function mentor(): HasOne
    {
        return $this->hasOne(Mentor::class);
    }

    /**
     * Get the user's funder profile
     */
    public function funder(): HasOne
    {
        return $this->hasOne(Funder::class);
    }

    /**
     * Get the user's UMKM owner profile
     */
    public function umkmOwner(): HasOne
    {
        return $this->hasOne(UmkmOwner::class);
    }

    /**
     * Get the posts created by this user
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'posted_by');
    }

    /**
     * Get the comments created by this user
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the comment replies created by this user
     */
    public function commentReplies(): HasMany
    {
        return $this->hasMany(CommentReply::class);
    }

    /**
     * Get the post likes by this user
     */
    public function postLikes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    /**
     * Get the verification logs created by this user (admin)
     */
    public function verificationLogs(): HasMany
    {
        return $this->hasMany(VerificationLog::class, 'verified_by');
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the user type based on which profile they have
     * Checks relationships in priority order: umkm_owner, mentor, funder
     */
    public function getUserType(): ?UserType
    {
        // Load relationships if not already loaded (optimizes queries)
        $this->loadMissing(['umkmOwner', 'mentor', 'funder']);

        // Check loaded relationships first (fastest)
        if ($this->relationLoaded('umkmOwner') && $this->umkmOwner !== null) {
            return UserType::UMKM_OWNER;
        }

        if ($this->relationLoaded('mentor') && $this->mentor !== null) {
            return UserType::MENTOR;
        }

        if ($this->relationLoaded('funder') && $this->funder !== null) {
            return UserType::FUNDER;
        }

        // Fallback: check if relationships exist (executes queries)
        // Order matters: check in priority order
        if ($this->umkmOwner()->exists()) {
            return UserType::UMKM_OWNER;
        }

        if ($this->mentor()->exists()) {
            return UserType::MENTOR;
        }

        if ($this->funder()->exists()) {
            return UserType::FUNDER;
        }

        return null;
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(UserRole ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    /**
     * Check if user has a specific type
     */
    public function hasType(UserType $type): bool
    {
        return $this->getUserType() === $type;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(UserRole::ADMIN);
    }

    /**
     * Check if user is government
     */
    public function isGovernment(): bool
    {
        return $this->hasRole(UserRole::GOVERNMENT);
    }

    /**
     * Check if user is regular user
     */
    public function isRegularUser(): bool
    {
        return $this->hasRole(UserRole::USER);
    }
}
