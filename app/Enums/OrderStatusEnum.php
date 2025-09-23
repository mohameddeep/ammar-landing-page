<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatusEnum: string
{
    use Enumable;

    case Pending = 'pending';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';

    public function t(): string
    {
        return match ($this) {
            self::Pending => __('Pending'),
            self::Processing => __('Processing'),
            self::Shipped => __('Shipped'),
            self::Delivered => __('Delivered'),
            self::Cancelled => __('Cancelled'),
            self::Refunded => __('Refunded'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Pending => 'ti ti-clock-hour-4',
            self::Processing => 'ti ti-package',
            self::Shipped => 'ti ti-truck-delivery',
            self::Delivered => 'ti ti-check',
            self::Cancelled => 'ti ti-x',
            self::Refunded => 'ti ti-coin-off',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-secondary',
            self::Processing => 'bg-info',
            self::Shipped => 'bg-warning',
            self::Delivered => 'bg-success',
            self::Cancelled => 'bg-danger',
            self::Refunded => 'bg-dark',
        };
    }
}
