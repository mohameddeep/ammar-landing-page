<?php

declare(strict_types=1);

namespace App\Enums;

enum CommissionValueTypeEnum: string
{
    use Enumable;

    case Percentage = 'percentage';
    case Fixed = 'fixed';

    public function t(): string
    {
        return match ($this) {
            self::Percentage => __('dashboard.percentage'),
            self::Fixed => __('dashboard.fixed'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Percentage => 'ti ti-percentage',
            self::Fixed => 'ti ti-currency-dollar',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Percentage => 'bg-primary',
            self::Fixed => 'bg-purple',
        };
    }
}
