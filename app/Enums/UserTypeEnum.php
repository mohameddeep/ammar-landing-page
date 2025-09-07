<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    use Enumable;

    case Shop = 'shop';
    case Designer = 'designer';
    case User = 'user';

    case Customer = 'customer';

    public function t(): string
    {
        return match ($this) {
            self::Shop => __('Shop'),
            self::Designer => __('Designer'),
            self::User => __('User'),
            self::Customer => __('Customer'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Shop => 'ti ti-building-store',
            self::Designer => 'ti ti-brush',
            self::User => 'ti ti-user-circle',
            self::Customer => 'ti ti-user-check',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Shop => 'bg-primary',
            self::Designer => 'bg-purple',
            self::User => 'bg-teal',
            self::Customer => 'bg-info',
        };
    }
}
