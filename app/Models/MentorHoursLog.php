<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorHoursLog extends Model
{
    use HasFactory;

    protected $table = 'mentor_hours_log';

    protected $fillable = [
        'mentor_id',
        'session_id',
        'hours_contributed',
        'earned_points',
        'star',
    ];

    protected function casts(): array
    {
        return [
            'star' => 'float',
        ];
    }

    /**
     * Get the mentor for this log
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    /**
     * Get the session for this log
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(MentorSession::class, 'session_id');
    }
}
