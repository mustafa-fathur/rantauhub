<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * Get the posts in this forum
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
