<?php

declare(strict_types=1);

namespace App\Enums;

enum UmkmCategory: string
{
    case KULINER = 'kuliner';
    case KERAJINAN = 'kerajinan';
    case PERTANIAN = 'pertanian';
    case FASHION = 'fashion';
    case LAINNYA = 'lainnya';

    public function label(): string
    {
        return match ($this) {
            self::KULINER => 'Kuliner',
            self::KERAJINAN => 'Kerajinan',
            self::PERTANIAN => 'Pertanian',
            self::FASHION => 'Fashion',
            self::LAINNYA => 'Lainnya',
        };
    }
}
