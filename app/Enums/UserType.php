<?php

declare(strict_types=1);

namespace App\Enums;

enum UserType: string
{
    case UMKM_OWNER = 'umkm_owner';
    case MENTOR = 'mentor';
    case FUNDER = 'funder';

    public function label(): string
    {
        return match ($this) {
            self::UMKM_OWNER => 'UMKM Owner',
            self::MENTOR => 'Mentor',
            self::FUNDER => 'Funder',
        };
    }
}
