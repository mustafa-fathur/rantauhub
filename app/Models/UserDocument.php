<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserDocumentStatus;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'related_type',
        'document_type',
        'file_path',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'related_type' => UserType::class,
            'status' => UserDocumentStatus::class,
        ];
    }

    /**
     * Get the user that owns this document
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
