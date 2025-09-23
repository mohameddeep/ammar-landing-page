<?php

declare(strict_types=1);

namespace App\Enums;

enum CommissionTypeEnum: string
{
    use Enumable;

    case Provider = 'provider';
    case Individual = 'individual';

    public function t(): string
    {
        return match ($this) {
            self::Provider => __('provider'),
            self::Individual => __('Individual'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Provider => 'ti ti-building-provider',
            self::Individual => 'ti ti-user-circle',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Provider => 'bg-primary',
            self::Individual => 'bg-teal',
        };
    }
}
