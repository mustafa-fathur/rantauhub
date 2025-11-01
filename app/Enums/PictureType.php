<?php

declare(strict_types=1);

namespace App\Enums;

enum PictureType: string
{
    case MENTOR = 'mentor';
    case UMKM = 'umkm';
    case FUNDER = 'funder';

    public function label(): string
    {
        return match ($this) {
            self::MENTOR => 'Mentor',
            self::UMKM => 'UMKM',
            self::FUNDER => 'Funder',
        };
    }
}
