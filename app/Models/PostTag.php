<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'tag',
    ];

    /**
     * Get the post that owns this tag
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
