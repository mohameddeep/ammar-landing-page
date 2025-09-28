<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderReturnStatusEnum: string
{
    use Enumable;

    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function t(): string
    {
        return match ($this) {
            self::PENDING => __('dashboard.pending'),
            self::ACCEPTED => __('dashboard.accepted'),
            self::REJECTED => __('dashboard.rejected'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PENDING  => 'ti ti-clock-hour-4',
            self::ACCEPTED => 'ti ti-circle-check',
            self::REJECTED => 'ti ti-circle-x',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING  => 'badge bg-warning',
            self::ACCEPTED => 'badge bg-success',
            self::REJECTED => 'badge bg-danger',
        };
    }
}
