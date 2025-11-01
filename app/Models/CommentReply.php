<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
        'body',
    ];

    /**
     * Get the comment this reply belongs to
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * Get the user who made this reply
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
