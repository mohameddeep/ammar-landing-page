<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    use Enumable;

    case Store = 'store';
    case Designer = 'designer';
    case Individual = 'individual';

    public function t(): string
    {
        return match ($this) {
        
            self::Store => __('store'),
            self::Designer => __('designer'),
            self::Individual => __('individual'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
             self::Store => 'ti ti-shopping-cart',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Store => 'text-warning',
        };
    }
}
