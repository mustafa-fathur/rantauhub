<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MentoringStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MentorSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_owner',
        'mentor_id',
        'topic',
        'scheduled_at',
        'duration_minutes',
        'status',
        'notes',
        'feedback',
        'rating',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'status' => MentoringStatus::class,
        ];
    }

    /**
     * Get the UMKM owner for this session
     */
    public function umkmOwner(): BelongsTo
    {
        return $this->belongsTo(UmkmOwner::class, 'umkm_owner');
    }

    /**
     * Get the mentor for this session
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    /**
     * Get the hours log for this session
     */
    public function hoursLog(): HasOne
    {
        return $this->hasOne(MentorHoursLog::class, 'session_id');
    }
}
