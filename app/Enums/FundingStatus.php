<?php

declare(strict_types=1);

namespace App\Enums;

enum FundingStatus: string
{
    case OPEN_REQUEST = 'open_request'; // Request dibuat UMKM, menunggu admin approve
    case OPEN = 'open'; // Request sudah disetujui admin, menunggu funder
    case PENDING = 'pending'; // Sudah ada funder, menunggu admin approve transfer
    case APPROVED = 'approved'; // Admin setujui transfer
    case REJECTED = 'rejected'; // Ditolak oleh admin
    case DISBURSED = 'disbursed'; // Sudah dicairkan

    public function label(): string
    {
        return match ($this) {
            self::OPEN_REQUEST => 'Menunggu Verifikasi Admin',
            self::OPEN => 'Open',
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            self::DISBURSED => 'Disbursed',
        };
    }
}
