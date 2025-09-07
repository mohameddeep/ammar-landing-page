<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatusEnum: string
{
    use Enumable;

    case Pending = 'pending';
    case Prepared = 'prepared';
    case OutForDelivery = 'out_for_delivery';
    case Delivered = 'delivered';

    public function t(): string
    {
        return match ($this) {
            self::Pending => __('Pending'),
            self::Prepared => __('Prepared'),
            self::OutForDelivery => __('Out for Delivery'),
            self::Delivered => __('Delivered'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Pending => 'ti ti-clock-hour-4',
            self::Prepared => 'ti ti-package',
            self::OutForDelivery => 'ti ti-truck-delivery',
            self::Delivered => 'ti ti-check',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-secondary',
            self::Prepared => 'bg-info',
            self::OutForDelivery => 'bg-warning',
            self::Delivered => 'bg-success',
        };
    }
}
