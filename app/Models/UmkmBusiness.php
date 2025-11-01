<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UmkmCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UmkmBusiness extends Model
{
    use HasFactory;

    protected $table = 'umkm_business';

    protected $fillable = [
        'owner_id',
        'name',
        'category',
        'other_category',
        'description',
        'location',
        'logo',
        'verified',
    ];

    protected function casts(): array
    {
        return [
            'category' => UmkmCategory::class,
            'verified' => 'boolean',
        ];
    }

    /**
     * Get the owner of this business
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(UmkmOwner::class, 'owner_id');
    }

    /**
     * Get the fundings for this business
     */
    public function fundings(): HasMany
    {
        return $this->hasMany(Funding::class, 'business_id');
    }

    /**
     * Get the pictures for this business
     */
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class, 'related_id')
            ->where('type', 'umkm');
    }
}
