<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case GOVERNMENT = 'government';

    public function label(): string
    {
        return match ($this) {
            self::USER => 'User',
            self::ADMIN => 'Admin',
            self::GOVERNMENT => 'Government',
        };
    }
}
