<?php

declare(strict_types=1);

namespace App\Enums;

enum PricingRequestStatus: string
{
    case New = 'new';
    case Contacted = 'contacted';
    case Quoted = 'quoted';
    case Closed = 'closed';

    public function label(): string
    {
        return __('dashboard.pricing_status_'.$this->value);
    }

    public function badge(): string
    {
        return match ($this) {
            self::New => 'bg-danger',
            self::Contacted => 'bg-warning',
            self::Quoted => 'bg-info',
            self::Closed => 'bg-success',
        };
    }
}
