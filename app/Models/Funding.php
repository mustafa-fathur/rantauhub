<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\FundingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Funding extends Model
{
    use HasFactory;

    protected $fillable = [
        'funder_id',
        'business_id',
        'amount',
        'proof_of_transfer',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => FundingStatus::class,
        ];
    }

    /**
     * Get the funder for this funding
     */
    public function funder(): BelongsTo
    {
        return $this->belongsTo(Funder::class);
    }

    /**
     * Get the business that received this funding
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(UmkmBusiness::class, 'business_id');
    }
}
