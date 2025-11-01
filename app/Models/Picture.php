<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PictureType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'related_id',
        'type',
        'caption',
        'filepath',
        'mime_type',
        'alt_text',
    ];

    protected function casts(): array
    {
        return [
            'type' => PictureType::class,
        ];
    }
}
