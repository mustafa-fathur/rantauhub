<?php

declare(strict_types=1);

namespace App\Enums;

enum FundingStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case DISBURSED = 'disbursed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            self::DISBURSED => 'Disbursed',
        };
    }
}
