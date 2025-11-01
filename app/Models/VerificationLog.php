<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserDocumentStatus;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'verified_by',
        'verified_entity_type',
        'verified_entity_id',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'verified_entity_type' => UserType::class,
            'status' => UserDocumentStatus::class,
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the admin who created this verification log
     */
    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
