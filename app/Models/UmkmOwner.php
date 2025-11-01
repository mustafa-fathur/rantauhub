<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UmkmOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'npwp',
        'verified',
    ];

    protected function casts(): array
    {
        return [
            'verified' => 'boolean',
        ];
    }

    /**
     * Get the user that owns this UMKM owner profile
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the businesses owned by this UMKM owner
     */
    public function businesses(): HasMany
    {
        return $this->hasMany(UmkmBusiness::class, 'owner_id');
    }

    /**
     * Get the mentor sessions for this UMKM owner
     */
    public function mentorSessions(): HasMany
    {
        return $this->hasMany(MentorSession::class, 'umkm_owner');
    }
}
