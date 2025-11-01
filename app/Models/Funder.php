<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Funder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_name',
        'verified',
    ];

    protected function casts(): array
    {
        return [
            'verified' => 'boolean',
        ];
    }

    /**
     * Get the user that owns this funder profile
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the fundings by this funder
     */
    public function fundings(): HasMany
    {
        return $this->hasMany(Funding::class);
    }

    /**
     * Get the pictures for this funder
     */
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class, 'related_id')
            ->where('type', 'funder');
    }
}
