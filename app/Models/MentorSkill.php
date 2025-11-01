<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'skill',
    ];

    /**
     * Get the mentor that owns this skill
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }
}
