<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'current_job',
        'experience',
        'about',
        'reputation_score',
        'verified',
    ];

    protected function casts(): array
    {
        return [
            'reputation_score' => 'float',
            'verified' => 'boolean',
        ];
    }

    /**
     * Get the user that owns this mentor profile
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the skills for this mentor
     */
    public function skills(): HasMany
    {
        return $this->hasMany(MentorSkill::class);
    }

    /**
     * Get the mentor sessions
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(MentorSession::class);
    }

    /**
     * Get the mentor hours logs
     */
    public function hoursLogs(): HasMany
    {
        return $this->hasMany(MentorHoursLog::class);
    }

    /**
     * Get the pictures for this mentor
     */
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class, 'related_id')
            ->where('type', 'mentor');
    }
}
